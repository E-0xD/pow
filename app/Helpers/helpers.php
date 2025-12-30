<?php

use Illuminate\Support\HtmlString;

if (!function_exists('getContactLink')) {
    function getContactLink($title, $value)
    {
        // Trim whitespace
        $value = trim($value);
        if (empty($value)) return '#';

        switch (strtolower($title)) {
            case 'email':
                if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return 'mailto:' . $value;
                }
                return $value; // Invalid email, return as is
            case 'phone':
                // Basic phone validation: allow digits, spaces, +, -, (, )
                if (preg_match('/^[\d\s\+\-\(\)]+$/', $value)) {
                    return 'tel:' . preg_replace('/\s+/', '', $value); // Remove spaces for tel:
                }
                return $value;
            case 'sms':
                if (preg_match('/^[\d\s\+\-\(\)]+$/', $value)) {
                    return 'sms:' . preg_replace('/\s+/', '', $value);
                }
                return $value;
            case 'location':
                // Assuming value is an address, link to Google Maps
                return 'https://maps.google.com/?q=' . urlencode($value);
            case 'facebook':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://facebook.com/' . ltrim($value, '@');
            case 'twitter':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://twitter.com/' . ltrim($value, '@');
            case 'instagram':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://instagram.com/' . ltrim($value, '@');
            case 'linkedin':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://linkedin.com/in/' . ltrim($value, '/in/');
            case 'youtube':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://youtube.com/@' . ltrim($value, '@');
            case 'tiktok':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://tiktok.com/@' . ltrim($value, '@');
            case 'snapchat':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://snapchat.com/add/' . $value;
            case 'pinterest':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://pinterest.com/' . $value;
            case 'reddit':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://reddit.com/u/' . ltrim($value, 'u/');
            case 'whatsapp':
                // Assuming value is phone number, remove + if present
                $number = ltrim($value, '+');
                if (preg_match('/^[\d\s\-\(\)]+$/', $number)) {
                    return 'https://wa.me/' . preg_replace('/\s+/', '', $number);
                }
                return $value;
            case 'telegram':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://t.me/' . ltrim($value, '@');
            case 'messenger':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://m.me/' . $value;
            case 'slack':
                // Slack might not have a direct profile link, default to value
                return $value;
            case 'discord':
                // Discord can be invite link or username, assume invite or handle as is
                return $value;
            case 'github':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://github.com/' . $value;
            case 'gitlab':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://gitlab.com/' . $value;
            case 'bitbucket':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://bitbucket.org/' . $value;
            case 'dribbble':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://dribbble.com/' . $value;
            case 'behance':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://behance.net/' . $value;
            case 'figma':
                // Figma might be file link, but assume profile
                if (str_starts_with($value, 'http')) return $value;
                return 'https://figma.com/@' . ltrim($value, '@');
            case 'stack overflow':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://stackoverflow.com/users/' . $value;
            case 'upwork':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://www.upwork.com/freelancers/' . $value;
            case 'fiverr':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://www.fiverr.com/' . $value;
            case 'freelancer':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://www.freelancer.com/u/' . $value;
            case 'medium':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://medium.com/@' . ltrim($value, '@');
            case 'substack':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://substack.com/@' . ltrim($value, '@');
            case 'patreon':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://patreon.com/' . $value;
            case 'ko-fi':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://ko-fi.com/' . $value;
            case 'calendly':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://calendly.com/' . $value;
            case 'zoom':
                // Zoom might be meeting link, assume as is
                return $value;
            case 'skype':
                return 'skype:' . $value;
            case 'signal':
                // Signal doesn't have web links easily, default
                return $value;
            case 'threads':
                if (str_starts_with($value, 'http')) return $value;
                return 'https://threads.net/@' . ltrim($value, '@');
            default:
                // For websites, assume value is already a URL
                return $value;
        }
    }
}

if (!function_exists('formatText')) {
    function formatText($text)
    {
        return new HtmlString(
            nl2br(e(ucfirst($text)))
        );
    }
}
