<transition enter-active-class="transform transition ease-out duration-300" enter-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-class="opacity-100" leave-to-class="opacity-0">
    <div v-if="showHelp" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 opacity-95"></div>
                <div class="absolute inset-0 bg-gray-900 opacity-40"></div>
            </div>
            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-12 pb-6 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-8" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" @click="completeSetup()" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <!-- Heroicon name: x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start pt-2 pb-4 border-b border-gray-100">
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-2xl leading-6 font-bold tracking-wide text-gray-700" id="modal-headline">
                            Getting started
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                This is a short overview how to use this application, if you encounter any issues or problems feel free to create a <a href="https://github.com/iandk/servermanager/issues" class="text-blue-400">Github issue</a>.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- SINGLE -->
                <div class="sm:flex sm:items-start pt-8 py-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-md leading-6 font-semibold text-gray-700" id="modal-headline">
                            Searching hosts
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                When searching for specific values, use the input field on the page header.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <!-- SINGLE -->
                <div class="sm:flex sm:items-start py-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-md leading-6 font-semibold text-gray-700" id="modal-headline">
                            Tagging hosts
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Use tags to group hosts, you can also filter for the tag by clicking on it.
                                Click again to remove the filter.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <!-- SINGLE -->
                <div class="sm:flex sm:items-start py-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-pink-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-md leading-6 font-semibold text-gray-700" id="modal-headline">
                            Monitoring
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                The application will perform a ping check in the background. 
                                If the host is up, the icon on the left will turn green, or red, if the host is down. <br />
                                Please keep in mind, that the hostname will be used for a ping check, not the IP(s)!
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
            </div>
        </div>
    </div>
</transition>