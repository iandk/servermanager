<div class="flex justify-between flex-wrap pt-2 md:pt-8 pb-12">
    <div class="pb-6 sm:py-0">
        <span class="text-white font-bold text-2xl lg:text-3xl align-top">
            <svg class="w-8 h-8 inline-block text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
            </svg>
            {{ title }}
        </span>
    </div>
    <div>
        <input required v-model="searchQuery" type="text" class="outline-none shadow-sm w-32 sm:text-sm h-10 px-3 rounded-md mr-1" placeholder="Search">
        <button @click="addHostOpen = !addHostOpen" class="bg-blue-500 hover:bg-blue-400 transition duration-200 ease-in-out rounded font-semibold text-white px-3 h-10 inline-block">
            <i class="fas fa-plus-circle opacity-50"></i>
            Add server
        </button>
    </div>
</div>

<div class="flex flex-col text-left">
    <div>
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-0">
            <!-- NO SEARCH RESULT -->
            <div v-if="!filteredHosts.length">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md max-w-xl mx-auto">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Oh snap, no results!
                                <span class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                    Please add a host or try a different search term.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="shadow overflow-hidden border-b border-gray-200 rounded-lg">
                <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tags
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Ressources
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Provider
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                IPs
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                OS
                            </th>
                            <th v-if="!disablePricing" scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Price per {{ billingTerm }}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="host in filteredHosts" class="hover:bg-gray-50">
                            <td class="px-6 py-8 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span v-if="pendingStatus" class="fa-stack text-blue-400 text-lg">
                                            <i class="fas fa-square fa-stack-2x"></i>
                                            <i class="fas fa-server fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <span v-else-if="hostStatus[host.id]" class="fa-stack text-green-400 text-lg">
                                            <i class="fas fa-square fa-stack-2x"></i>
                                            <i class="fas fa-server fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <span v-else class="fa-stack text-red-400 text-lg">
                                            <i class="fas fa-square fa-stack-2x"></i>
                                            <i class="fas fa-server fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-md font-bold text-indigo-500">
                                            <a :href="'https://' + host.hostname + '/'" target="_blank">{{ host.name }}</a>
                                        </div>
                                        <div class="text-sm font-medium text-gray-600">
                                            <a :href="'https://' + host.hostname + '/'" target="_blank">{{ host.hostname }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 ">
                                <div class="text-sm text-gray-600">
                                    <div v-for="tag in filterTags(host.tags)" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-pink-100 text-pink-800 m-1">
                                        {{ tag }}
                                    </div>
                                    <div v-if="host.tags === 'undefined' || host.tags === 'null' || !host.tags" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium border border-dashed border-gray-300 text-gray-300 m-1">
                                        none
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-600">{{ orDefault(host.ressources) }}</div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-600">{{ orDefault(host.location) }}</div>
                            </td>

                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-600">{{ orDefault(host.provider) }}</div>
                            </td>

                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-600">{{ orDefault(host.ips) }}</div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-600">{{ orDefault(host.type) }}</div>
                            </td>

                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-600">{{ orDefault(host.os) }}</div>
                            </td>

                            <td v-if="!disablePricing" class="px-6 py-6">
                                <div v-if="!isUndefined(host.price)" class="text-sm text-gray-600">{{ host.price }}{{ currency }}</div>
                                <div v-else class="text-sm text-gray-600">-</div>
                            </td>
                            <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="editServer(host.id)">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                                <button @click="toggelDeleteModal(host.id)">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>