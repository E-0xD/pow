#!/usr/bin/env bash

# Nightwatch Agent Keeper
# Monitors the nightwatch agent by PID and restarts if not running
# Run via cron: */5 * * * * /path/to/nightwatch-keeper.sh

# Change to project directory
cd "$(dirname "$0")" || exit 1

PID_FILE="storage/.nightwatch.pid"
LOG_FILE="storage/logs/nightwatch-monitor.log"

log_message() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1" >> "$LOG_FILE"
}

check_process_running() {
    local pid=$1
    if kill -0 "$pid" 2>/dev/null; then
        return 0
    else
        return 1
    fi
}

start_agent() {
    log_message "Starting Nightwatch agent..."
    
    # Kill any orphaned processes
    pkill -f "php artisan nightwatch:agent" 2>/dev/null
    sleep 1
    
    # Start the agent in background and capture error output
    nohup php artisan nightwatch:agent >> "$LOG_FILE" 2>&1 &
    local new_pid=$!
    
    # Save the PID to file
    echo "$new_pid" > "$PID_FILE"
    
    sleep 3
    
    if check_process_running "$new_pid"; then
        log_message "Agent started successfully (PID: $new_pid)"
        return 0
    else
        log_message "Failed to start agent (PID: $new_pid)"
        log_message "Check if php/artisan commands are available"
        rm -f "$PID_FILE"
        return 1
    fi
}

# Main logic
log_message "Nightwatch Monitor Check"

if [ -f "$PID_FILE" ]; then
    # PID file exists, check if process is running
    saved_pid=$(cat "$PID_FILE")
    
    if check_process_running "$saved_pid"; then
        log_message "Agent is running (PID: $saved_pid)"
    else
        log_message "Agent process $saved_pid is not running"
        start_agent
    fi
else
    # No PID file, need to start agent
    log_message "No PID file found, starting agent..."
    start_agent
fi