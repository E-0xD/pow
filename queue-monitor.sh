#!/bin/bash

# Laravel Queue Monitor Script
# Tracks queue:work by PID and restarts if needed

# Configuration
LARAVEL_PATH="$(cd "$(dirname "$0")" && pwd)"  # Gets the directory where script is located
QUEUE_CONNECTION="database"  # Change to your queue connection name
LOG_FILE="$LARAVEL_PATH/storage/logs/queue-monitor.log"
PID_FILE="$LARAVEL_PATH/storage/logs/queue-worker.pid"

# Function to log messages with timestamp
log_message() {
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $1" >> "$LOG_FILE"
}

# Function to check if queue worker is running by PID
is_queue_running() {
    if [ -f "$PID_FILE" ]; then
        PID=$(cat "$PID_FILE")
        if kill -0 "$PID" 2>/dev/null; then
            return 0  # Process is running
        else
            log_message "Process with PID $PID is not running, removing stale PID file"
            rm -f "$PID_FILE"
            return 1  # Process is not running
        fi
    else
        return 1  # No PID file exists
    fi
}

# Function to start queue:work
start_queue() {
    cd "$LARAVEL_PATH" || {
        log_message "ERROR: Cannot change to Laravel directory: $LARAVEL_PATH"
        exit 1
    }
    
    # Start queue:work in background
    nohup php artisan queue:work "$QUEUE_CONNECTION" \
        --tries=3 \
        --timeout=90 \
        --sleep=3 \
        --max-jobs=1000 \
        >> "$LOG_FILE" 2>&1 &
    
    # Store the process ID
    QUEUE_PID=$!
    echo "$QUEUE_PID" > "$PID_FILE"
    
    # Wait a moment for the process to start
    sleep 3
    
    # Verify the process started successfully
    if kill -0 "$QUEUE_PID" 2>/dev/null; then
        log_message "Queue worker started successfully for connection: $QUEUE_CONNECTION (PID: $QUEUE_PID)"
    else
        log_message "ERROR: Failed to start queue worker"
        rm -f "$PID_FILE"
    fi
}

# Create storage/logs directory if it doesn't exist
mkdir -p "$LARAVEL_PATH/storage/logs"

# Main execution
if is_queue_running; then
    # Queue is running
    # log_message "Queue worker is running (PID: $(cat "$PID_FILE"))"
    exit 0
else
    log_message "Queue worker not running, starting new worker"
    start_queue
    exit 0
fi