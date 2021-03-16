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
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-md leading-6 font-semibold text-gray-700" id="modal-headline">
                            Adding hosts
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                You can add a new host by clicking the button on the top right corner.
                                Only the description and hostname are mandatory.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <!-- SINGLE -->
                <div class="sm:flex sm:items-start py-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-md leading-6 font-semibold text-gray-700" id="modal-headline">
                            Editing hosts
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Click on the pencil on the right side of the table if you want to edit an existing host.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <!-- SINGLE -->
                <div class="sm:flex sm:items-start py-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-md leading-6 font-semibold text-gray-700" id="modal-headline">
                            Deleting hosts
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Hosts can be deleted by clicking on the trashcan symbol.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <!-- SINGLE -->
                <div class="sm:flex sm:items-start py-4">
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
                                Use tags to group hosts, by clicking on the tag you can filter for it.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END -->
            </div>
        </div>
    </div>
</transition>