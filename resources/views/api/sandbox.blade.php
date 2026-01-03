<x-layouts.guest>
    <div class="mx-auto max-w-7xl">
        <!-- PageHeading -->
        <div class="mb-6">
            <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">API Sandbox</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Test the Partner API in sandbox mode (no real users created)
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Request Form -->
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Request Builder</h2>
                <form id="apiForm" class="space-y-4">
                    <div>
                        <label for="endpoint"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Endpoint</label>
                        <select id="endpoint"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 shadow-sm focus:border-primary focus:ring-primary">
                            <option value="create-user">POST /api/partners/users - Create User</option>
                        </select>
                    </div>

                    <div>
                        <label for="apiKey" class="block text-sm font-medium text-gray-700 dark:text-gray-300">API
                            Key</label>
                        <input type="password" id="apiKey" placeholder="Enter your API key"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 shadow-sm focus:border-primary focus:ring-primary" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">In sandbox mode, your live key works
                        </p>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User
                            Name</label>
                        <input type="text" id="name" placeholder="John Doe"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 shadow-sm focus:border-primary focus:ring-primary" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User
                            Email</label>
                        <input type="text" id="email" placeholder="john@example.com"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 shadow-sm focus:border-primary focus:ring-primary" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User
                            Password</label>
                        <input type="password" id="password" placeholder="password"
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 shadow-sm focus:border-primary focus:ring-primary" />
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-md hover:bg-primary/90 focus:ring-2 focus:ring-primary/50">
                        Send Request
                    </button>
                </form>

                <!-- Request Display -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">Request Preview</h3>
                    <pre id="requestDisplay"
                        class="bg-gray-100 dark:bg-gray-900 p-3 rounded text-xs text-gray-800 dark:text-gray-200 overflow-auto max-h-64"><span class="text-gray-500">POST /api/partners/users
Authorization: Bearer YOUR_API_KEY
Content-Type: application/json

{
  "name": "",
  "email": "",
  "password": ""
}</span></pre>
                </div>

                <!-- Sandbox Badge -->
                <div
                    class="mt-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded">
                    <p class="text-sm text-yellow-800 dark:text-yellow-300">
                        <strong>🏖️ Sandbox Mode:</strong> Requests are not saved to the database
                    </p>
                </div>
            </div>

            <!-- Response Display -->
            <div class="bg-white dark:bg-[#20152d] rounded-xl p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Response</h2>

                <div id="responseContainer" class="hidden">
                    <div class="mb-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Status Code:</span>
                            <span id="statusCode"
                                class="px-3 py-1 rounded-full text-sm font-semibold text-white bg-green-600"></span>
                        </div>
                    </div>
                    <pre id="responseDisplay"
                        class="bg-gray-100 dark:bg-gray-900 p-3 rounded text-xs text-gray-800 dark:text-gray-200 overflow-auto max-h-96"></pre>
                </div>

                <div id="noResponse" class="text-gray-500 dark:text-gray-400">
                    Submit a request to see the response here
                </div>

                <!-- Error Display -->
                <div id="errorContainer"
                    class="hidden mt-4 p-3 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 rounded">
                    <p class="text-sm font-semibold text-red-800 dark:text-red-400">Error:</p>
                    <p id="errorMessage" class="text-sm text-red-700 dark:text-red-300 mt-1"></p>
                </div>
            </div>
        </div>

        <!-- Documentation Link -->
        <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-300 mb-2">📚 Full API Documentation</h3>
            <p class="text-blue-800 dark:text-blue-400 mb-4">View complete API documentation including all endpoints,
                authentication, and code examples in multiple languages.</p>
            <a href="{{ route('api.documentation') }}"
                class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 font-semibold">
                Read Documentation
                <span class="material-symbols-outlined text-lg ml-1">arrow_outward</span>
            </a>
        </div>
    </div>

    <script>
        const form = document.getElementById('apiForm');
        const apiKeyInput = document.getElementById('apiKey');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const endpointSelect = document.getElementById('endpoint');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const apiKey = apiKeyInput.value;
            const name = nameInput.value;
            const email = emailInput.value;
            const password = passwordInput.value;
            const endpoint = endpointSelect.value;

            if (!apiKey || !name || !email || !password) {
                showError('Please fill in all fields');
                return;
            }

            updateRequestDisplay(name, email, password, apiKey, endpoint);

            try {
                const response = await fetch('/api/sandbox/test-create-user', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${apiKey}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        password
                    })
                });

                const data = await response.json();
                showResponse(data, response.status);
            } catch (error) {
                showError('Network error: ' + error.message);
            }
        });

        function updateRequestDisplay(name, email, password, apiKey, endpoint) {
            const request = `POST /api/partners/users
Authorization: Bearer ${apiKey.substring(0, 10)}...
Content-Type: application/json

{
  "name": "${name}",
  "email": "${email}",
  "password": "${password}"
}`;
            document.getElementById('requestDisplay').textContent = request;
        }

        function showResponse(data, statusCode) {
            document.getElementById('responseContainer').classList.remove('hidden');
            document.getElementById('noResponse').classList.add('hidden');
            document.getElementById('errorContainer').classList.add('hidden');

            const statusElement = document.getElementById('statusCode');
            statusElement.textContent = statusCode;
            statusElement.className = statusCode == 201 ?
                'px-3 py-1 rounded-full text-sm font-semibold text-white bg-green-600' :
                'px-3 py-1 rounded-full text-sm font-semibold text-white bg-red-600';

            document.getElementById('responseDisplay').textContent = JSON.stringify(data, null, 2);
        }

        function showError(message) {
            document.getElementById('errorContainer').classList.remove('hidden');
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('responseContainer').classList.add('hidden');
            document.getElementById('noResponse').classList.add('hidden');
        }
    </script>
</x-layouts.guest>
