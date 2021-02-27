<transition enter-active-class="transform transition ease-out duration-300" enter-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-class="opacity-100" leave-to-class="opacity-0">
  <div v-if="editHostOpen" @keydown.esc="editHostOpen = cancelForm(editHostOpen)" tabindex="-1" class="fixed z-50 inset-0 overflow-hidden">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-900 opacity-95"></div>
    </div>
    <div class="absolute inset-0 overflow-hidden">
      <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex" aria-labelledby="slide-over-heading">
        <div class="w-screen max-w-md">
          <div class="h-full divide-y divide-gray-200 flex flex-col bg-white shadow-xl">
            <div class="min-h-0 flex-1 flex flex-col pb-6 overflow-y-scroll">
              <div class="px-4 sm:px-6 bg-blue-500 py-8">
                <div class="flex items-start justify-between">
                  <h2 id="slide-over-heading" class="text-lg lg:text-xl font-medium text-white">
                    Edit server
                  </h2>
                  <div class="ml-3 h-7 flex items-center">
                    <button @click="editHostOpen = cancelForm(editHostOpen)" class="bg-blue-600 rounded-md text-white hover:text-blue-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                      <span class="sr-only">Close panel</span>
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div v-if="!pendingEditResponse" class="mt-6 relative flex-1 px-4 sm:px-6">
                <div class="container mx-auto max-w-lg bg-white rounded">
                  <!-- ERRORS -->
                  <div v-for="error in errors" class="mt-1 mb-4">
                    <div class="rounded-md bg-red-50 p-4">
                      <div class="flex">
                        <div class="flex-shrink-0">
                          <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                        </div>
                        <div class="ml-3">
                          <p class="text-sm font-medium text-red-800">
                            {{ error }}
                          </p>
                        </div>
                        <div class="ml-auto pl-3">
                          <div class="-mx-1.5 -my-1.5">
                            <button @click="clearErrors" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none">
                              <span class="sr-only">Dismiss</span>
                              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                              </svg>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END -->
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">ID</label>
                    <div class="mt-1">
                      <input disabled required v-model="id" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="ID">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Description *</label>
                    <div class="mt-1">
                      <input required v-model="name" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="web">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Hostname *</label>
                    <div class="mt-1">
                      <input required v-model="hostname" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="web.mydomain.io">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Location</label>
                    <div class="mt-1">
                      <input v-model="location" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="Frankfurt">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Tags</label>
                    <div class="mt-1">
                      <input v-model="tags" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="web, app, database">
                    </div>
                  </div>
                  <div>
                    <div class="pt-8 pb-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Ressources</label>
                      <div class="mt-1">
                        <input v-model="ressources" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="1C/2GB/20GB-NVME">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Provider</label>
                      <div class="mt-1">
                        <input v-model="provider" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="Hetzner">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Type</label>
                      <div class="mt-1">
                        <input v-model="type" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="LXC/ KVM/ Baremetal">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">OS</label>
                      <div class="mt-1">
                        <input v-model="os" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="Debian 10">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">IPs</label>
                      <div class="mt-1">
                        <input v-model="ips" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="10.0.0.1, fd00::1">
                      </div>
                    </div>
                    <div v-if="!disablePricing" class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Price per {{ billingTerm }}</label>
                      <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm">
                            {{ currency }}
                          </span>
                        </div>
                        <input v-model="price" class="pl-7 pr-12 outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="10">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Notes</label>
                      <div class="mt-1">
                        <textarea v-model="notes" rows="3" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="....">
                        </textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div v-else class="py-4">
                <i class="fas fa-circle-notch fa-spin text-gray-400"></i>
                Waiting for response..
              </div>
            </div>
            <div class="flex-shrink-0 px-4 py-4 flex justify-end">
              <button @click="editHostOpen = cancelForm(editHostOpen)" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
              </button>
              <button @click="addServer(id)" type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</transition>