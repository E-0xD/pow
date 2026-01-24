#!/usr/bin/env pwsh

# Nightwatch Agent Watcher
# Monitors the nightwatch agent and restarts it if it stops running

$agentProcess = $null
$statusCheckInterval = 5  # Check every 5 seconds
$restartDelay = 2  # Wait 2 seconds before restarting

function Start-NightwatchAgent {
    Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Starting Nightwatch agent..." -ForegroundColor Cyan
    
    $process = Start-Process -FilePath "php" -ArgumentList "artisan", "nightwatch:agent" `
        -NoNewWindow -PassThru
    
    if ($process) {
        Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Nightwatch agent started (PID: $($process.Id))" -ForegroundColor Green
        return $process
    } else {
        Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Failed to start Nightwatch agent" -ForegroundColor Red
        return $null
    }
}

function Test-NightwatchAgent {
    try {
        $output = & php artisan nightwatch:status 2>&1
        $outputString = $output -join " "
        
        if ($outputString -like "*The Nightwatch agent is running*") {
            return $true
        } else {
            return $false
        }
    } catch {
        return $false
    }
}

# Main loop
Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Nightwatch Agent Watcher started" -ForegroundColor Yellow

$agentProcess = Start-NightwatchAgent

while ($true) {
    Start-Sleep -Seconds $statusCheckInterval
    
    # Check if process still exists
    if ($agentProcess -and -not (Get-Process -Id $agentProcess.Id -ErrorAction SilentlyContinue)) {
        Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Agent process no longer exists" -ForegroundColor Red
        $agentProcess = $null
    }
    
    # Check agent status
    if (-not (Test-NightwatchAgent)) {
        Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Agent is not responding, attempting restart..." -ForegroundColor Yellow
        
        if ($agentProcess) {
            try {
                Stop-Process -Id $agentProcess.Id -Force -ErrorAction SilentlyContinue
            } catch {}
        }
        
        Start-Sleep -Seconds $restartDelay
        $agentProcess = Start-NightwatchAgent
    } else {
        Write-Host "$(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') - Agent is running" -ForegroundColor Green
    }
}
