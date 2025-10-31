// Track clicks on any clickable element
document.addEventListener('click', function(event) {
    let target = event.target;
    
    // Find the closest clickable element (link or button)
    while (target && !(target instanceof HTMLAnchorElement || target instanceof HTMLButtonElement)) {
        target = target.parentElement;
    }

    if (!target) return;

    const data = {
        element_type: target.tagName.toLowerCase(),
        element_id: target.id || null,
        page_url: window.location.pathname,
        clicked_url: target instanceof HTMLAnchorElement ? target.href : null
    };

    // Send click data to the server
    fetch('/portfolio-analytics/track-click', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    }).catch(console.error);
});