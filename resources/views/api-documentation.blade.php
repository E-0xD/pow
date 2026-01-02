<x-layouts.guest>
    <div class="mx-auto max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-gray-900 dark:text-white text-4xl font-bold leading-tight tracking-tight">API Documentation
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-3">Complete guide to integrating with the {{config('app.name')}} Partner API</p>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <a href="#endpoints"
                class="bg-white dark:bg-[#20152d] rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary transition">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-2xl text-primary">api</span>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">API Endpoints</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">View all available endpoints</p>
                    </div>
                </div>
            </a>
            <a href="#authentication"
                class="bg-white dark:bg-[#20152d] rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary transition">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-2xl text-primary">security</span>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Authentication</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">How to authenticate requests</p>
                    </div>
                </div>
            </a>
            <a href="#sandbox"
                class="bg-white dark:bg-[#20152d] rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary transition">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-2xl text-primary">explore</span>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Sandbox</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Test the API in sandbox mode</p>
                    </div>
                </div>
            </a>
            <a href="#examples"
                class="bg-white dark:bg-[#20152d] rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary transition">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-2xl text-primary">code</span>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Code Examples</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Integration examples in multiple languages
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Authentication Section -->
        <section id="authentication" class="mb-12">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Authentication</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    All API requests require authentication using a Bearer token. Include your API key in the
                    Authorization header:
                </p>
                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg mb-4">
                    <code class="text-gray-800 dark:text-gray-200">Authorization: Bearer YOUR_API_KEY</code>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    Your API key is automatically generated when you create a partner account in the admin dashboard.
                </p>
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <p class="text-sm text-blue-800 dark:text-blue-300">
                        <strong>🔐 Security:</strong> Never expose your API key in client-side code. Always keep it
                        secret and store it securely in environment variables.
                    </p>
                </div>
            </div>
        </section>

        <!-- Sandbox Section -->
        <section id="sandbox" class="mb-12">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">API Sandbox</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Use our interactive sandbox to test the API without creating real users. Perfect for development and
                    testing.
                </p>
                <a href="{{ route('api.sandbox') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 font-semibold">
                    <span class="material-symbols-outlined">launch</span>
                    Open Sandbox
                </a>
            </div>
        </section>

        <!-- Endpoints Section -->
        <section id="endpoints" class="mb-12">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">API Endpoints</h2>

                <!-- Create User Endpoint -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-8 mb-8 last:border-b-0">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Create User</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Create a new user account through your
                                partner account</p>
                        </div>
                        <span
                            class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-3 py-1 rounded-full text-sm font-semibold">POST</span>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Endpoint</h4>
                            <code
                                class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-3 py-2 rounded block">/api/partners/users</code>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Parameters</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="bg-gray-100 dark:bg-gray-800">
                                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Name</th>
                                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Type</th>
                                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Required
                                            </th>
                                            <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Description
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-t border-gray-200 dark:border-gray-700">
                                            <td class="px-4 py-2 text-gray-900 dark:text-white">name</td>
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">string</td>
                                            <td class="px-4 py-2"><span
                                                    class="bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 px-2 py-1 rounded text-xs">Yes</span>
                                            </td>
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">User's full name (max
                                                255)</td>
                                        </tr>
                                        <tr
                                            class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                                            <td class="px-4 py-2 text-gray-900 dark:text-white">email</td>
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">string</td>
                                            <td class="px-4 py-2"><span
                                                    class="bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 px-2 py-1 rounded text-xs">Yes</span>
                                            </td>
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">Unique email address
                                            </td>
                                        </tr>
                                        <tr class="border-t border-gray-200 dark:border-gray-700">
                                            <td class="px-4 py-2 text-gray-900 dark:text-white">password</td>
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">string</td>
                                            <td class="px-4 py-2"><span
                                                    class="bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 px-2 py-1 rounded text-xs">Yes</span>
                                            </td>
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">Password (min 8
                                                characters)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Success Response (201)</h4>
                            <pre class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4 rounded overflow-x-auto text-sm"><code>{
  "status": "success",
  "message": "User created successfully",
  "user": {
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2026-01-02T10:30:00.000000Z"
  }
}</code></pre>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Error Responses</h4>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Validation
                                        Error (422)</p>
                                    <pre class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4 rounded overflow-x-auto text-xs"><code>{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "email": ["The email has already been taken."],
    "password": ["The password field is required."]
  }
}</code></pre>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unauthorized
                                        (401)</p>
                                    <pre class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 p-4 rounded overflow-x-auto text-xs"><code>{
  "status": "error",
  "message": "Invalid API key"
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Code Examples Section -->
        <section id="examples" class="mb-12">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Integration Examples</h2>

                <!-- Language Tabs -->
                <div class="flex space-x-2 border-b border-gray-200 dark:border-gray-700 mb-6 overflow-x-auto">
                    <button onclick="showLanguage('curl')"
                        class="languageTab active px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border-b-2 border-primary whitespace-nowrap">cURL</button>
                    <button onclick="showLanguage('javascript')"
                        class="languageTab px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap">JavaScript</button>
                    <button onclick="showLanguage('python')"
                        class="languageTab px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap">Python</button>
                    <button onclick="showLanguage('php')"
                        class="languageTab px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap">PHP</button>
                    <button onclick="showLanguage('ruby')"
                        class="languageTab px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border-b-2 border-transparent hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap">Ruby</button>
                </div>

                <!-- Code Examples -->
                <div id="curl" class="codeExample">
                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded text-sm text-gray-800 dark:text-gray-200 overflow-x-auto"><code>curl -X POST https://pow.test/api/partners/users \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "securepassword123"
  }'</code></pre>
                </div>

                <div id="javascript" class="codeExample hidden">
                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded text-sm text-gray-800 dark:text-gray-200 overflow-x-auto"><code>const apiKey = 'YOUR_API_KEY';

fetch('https://pow.test/api/partners/users', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${apiKey}`,
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    name: 'John Doe',
    email: 'john@example.com',
    password: 'securepassword123'
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));</code></pre>
                </div>

                <div id="python" class="codeExample hidden">
                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded text-sm text-gray-800 dark:text-gray-200 overflow-x-auto"><code>import requests

api_key = 'YOUR_API_KEY'
url = 'https://pow.test/api/partners/users'

headers = {
    'Authorization': f'Bearer {api_key}',
    'Content-Type': 'application/json'
}

data = {
    'name': 'John Doe',
    'email': 'john@example.com',
    'password': 'securepassword123'
}

response = requests.post(url, json=data, headers=headers)
print(response.json())</code></pre>
                </div>

                <div id="php" class="codeExample hidden">
                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded text-sm text-gray-800 dark:text-gray-200 overflow-x-auto"><code>$apiKey = 'YOUR_API_KEY';
$url = 'https://pow.test/api/partners/users';

$data = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'securepassword123'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
echo json_decode($response, true);
curl_close($ch);</code>
                </div>

                <div id="ruby" class="codeExample hidden">
                    <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded text-sm text-gray-800 dark:text-gray-200 overflow-x-auto"><code>require 'net/http'
require 'json'

api_key = 'YOUR_API_KEY'
url = URI('https://pow.test/api/partners/users')

http = Net::HTTP.new(url.host, url.port)
http.use_ssl = true

request = Net::HTTP::Post.new(url)
request['Authorization'] = "Bearer #{api_key}"
request['Content-Type'] = 'application/json'
request.body = {
  name: 'John Doe',
  email: 'john@example.com',
  password: 'securepassword123'
}.to_json

response = http.request(request)
puts JSON.parse(response.body)</code></pre>
                </div>
            </div>
        </section>

        <!-- Best Practices -->
        <section class="mb-12">
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Best Practices</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">security</span>
                            Security
                        </h3>
                        <ul class="text-gray-600 dark:text-gray-400 space-y-2 text-sm">
                            <li>• Never expose API keys in client-side code</li>
                            <li>• Store keys securely in environment variables</li>
                            <li>• Rotate keys periodically</li>
                            <li>• Use HTTPS for all requests</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">check_circle</span>
                            Validation
                        </h3>
                        <ul class="text-gray-600 dark:text-gray-400 space-y-2 text-sm">
                            <li>• Validate inputs before sending</li>
                            <li>• Always check response status</li>
                            <li>• Handle all error scenarios</li>
                            <li>• Log errors for debugging</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">speed</span>
                            Performance
                        </h3>
                        <ul class="text-gray-600 dark:text-gray-400 space-y-2 text-sm">
                            <li>• Implement retry logic with backoff</li>
                            <li>• Cache responses when possible</li>
                            <li>• Batch operations for efficiency</li>
                            <li>• Monitor API usage</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">help</span>
                            Support
                        </h3>
                        <ul class="text-gray-600 dark:text-gray-400 space-y-2 text-sm">
                            <li>• Check documentation frequently</li>
                            <li>• Use sandbox for testing</li>
                            <li>• Test in staging before production</li>
                            <li>• Contact support for issues</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Support -->
        <section>
            <div
                class="bg-gradient-to-r from-primary/10 to-primary/5 dark:from-primary/10 dark:to-primary/5 border border-primary/20 dark:border-primary/20 rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Need Help?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    If you have questions or need support, our team is here to help.
                </p>
                <a href="mailto:support@pow.test"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 font-semibold">
                    <span class="material-symbols-outlined">mail</span>
                    Contact Support
                </a>
            </div>
        </section>
    </div>

    <script>
        function showLanguage(language) {
            // Hide all code examples
            document.querySelectorAll('.codeExample').forEach(el => el.classList.add('hidden'));
            document.getElementById(language).classList.remove('hidden');

            // Update active tab
            document.querySelectorAll('.languageTab').forEach(btn => {
                btn.classList.remove('border-primary');
                btn.classList.add('border-transparent', 'hover:border-gray-300', 'dark:hover:border-gray-600');
            });
            event.target.classList.add('border-primary');
            event.target.classList.remove('border-transparent', 'hover:border-gray-300', 'dark:hover:border-gray-600');
        }
    </script>
    </x-layouts.app>
