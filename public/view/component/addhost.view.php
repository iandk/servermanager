<transition enter-active-class="transform transition ease-out duration-300" enter-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-class="opacity-100" leave-to-class="opacity-0">
  <div v-if="addHostOpen" class="fixed z-50 inset-0 overflow-hidden">
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
                    Add server
                  </h2>
                  <div class="ml-3 h-7 flex items-center">
                    <button @click="addHostOpen = !addHostOpen" class="bg-blue-600 rounded-md text-white hover:text-blue-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                      <span class="sr-only">Close panel</span>
                      <!-- Heroicon name: x -->
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="mt-6 relative flex-1 px-4 sm:px-6">
                <div class="container mx-auto max-w-lg bg-white rounded">
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Description</label>
                    <div class="mt-1">
                      <input required v-model="name" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="web">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Hostname</label>
                    <div class="mt-1">
                      <input required v-model="hostname" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="web.mydomain.io">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Location</label>
                    <div class="mt-1">
                      <input required v-model="location" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="Frankfurt">
                    </div>
                  </div>
                  <div class="py-2">
                    <label class="block text-sm font-medium text-gray-600 text-left">Tags</label>
                    <div class="mt-1">
                      <input required v-model="tags" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="web, app, database">
                    </div>
                  </div>
                  <div>
                    <div class="pt-8 pb-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Ressources</label>
                      <div class="mt-1">
                        <input required v-model="ressources" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="1vCore, 2GB RAM, 20GB NVMe">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Provider</label>
                      <div class="mt-1">
                        <input required v-model="provider" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="Hetzner">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Type</label>
                      <div class="mt-1">
                        <input required v-model="type" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="LXC/ KVM/ Baremetal">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">OS</label>
                      <div class="mt-1">
                        <input required v-model="os" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="Debian 10">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">IPs</label>
                      <div class="mt-1">
                        <input required v-model="ips" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="10.0.0.1, fd00::1">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Price per {{ billingTerm }}</label>
                      <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <span class="text-gray-500 sm:text-sm">
                            {{ currency }}
                          </span>
                        </div>
                        <input required v-model="price" class="pl-7 pr-12 outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="10">
                      </div>
                    </div>
                    <div class="py-2">
                      <label class="block text-sm font-medium text-gray-600 text-left">Notes</label>
                      <div class="mt-1">
                        <textarea required v-model="notes" class="outline-none shadow-sm block w-full sm:text-sm border-2 border-gray-200 py-2 px-3 rounded-md" placeholder="....">
                        </textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex-shrink-0 px-4 py-4 flex justify-end">
              <button @click="addHostOpen = !addHostOpen" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
              </button>
              <button @click="addServer()" type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Add
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</transition>