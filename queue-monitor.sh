#!/bin/bash

# Laravel Queue Monitor Script (Fixed)
# Ensures queue:work runs continuously and restarts if stopped

# Configuration
LARAVEL_PATH="$(cd "$(dirname "$0")" && pwd)" # Laravel app directory
QUEUE_CONNECTION="database"                   # Adjust your queue connection
LOG_FILE="$LARAVEL_PATH/storage/logs/queue-monitor.log"
PID_FILE="$LARAVEL_PATH/storage/logs/queue-worker.pid"

# Function to log with timestamp
log_message() {
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $1" >> "$LOG_FILE"
}

# Check if queue worker is running
is_queue_running() {
    if [ -f "$PID_FILE" ]; then
        PID=$(cat "$PID_FILE")
        if ps -p "$PID" > /dev/null 2>&1; then
            return 0
        else
            log_message "Process with PID $PID not running, removing stale PID file"
            rm -f "$PID_FILE"
            return 1
        fi
    else
        return 1
    fi
}

# Start queue worker
start_queue() {
    cd "$LARAVEL_PATH" || {
        log_message "ERROR: Cannot change to Laravel directory: $LARAVEL_PATH"
        exit 1
    }

    # Ensure Laravel works properly
    if ! php artisan --version > /dev/null 2>&1; then
        log_message "ERROR: Artisan not found or Laravel not initialized in $LARAVEL_PATH"
        exit 1
    fi

    # Start the worker
    nohup php artisan queue:work\
        --tries=3 \
        --timeout=90 \
        --sleep=3 \
        --max-jobs=1000 \
        >> "$LOG_FILE" 2>&1 &

    QUEUE_PID=$!
    echo "$QUEUE_PID" > "$PID_FILE"
    sleep 2

    if ps -p "$QUEUE_PID" > /dev/null 2>&1; then
        log_message "Queue worker started successfully (PID: $QUEUE_PID)"
    else
        log_message "ERROR: Failed to start queue worker"
        rm -f "$PID_FILE"
    fi
}

# Create log directory if missing
mkdir -p "$LARAVEL_PATH/storage/logs"

# Main execution
if is_queue_running; then
    # Queue worker is running, no action
    # log_message "Queue worker running (PID: $(cat "$PID_FILE"))"
    exit 0
else
    log_message "Queue worker not running, starting new worker"
    start_queue
    exit 0
fi
