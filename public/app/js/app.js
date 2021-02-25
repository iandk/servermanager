var app = new Vue({
   el: '#app',
   data: {
     currency: '€',
     billingTerm: 'month',
     // Form values
     hosts: null,
     status: null,
     id: null,
     name: null,
     hostname: null,
     location: null,
     tags: null,
     ressources: null,
     provider: null,
     ips: null,
     price: null,
     type: null,
     notes: null,
     os: null,
     // State of UI objects
     sidebarOpen: false,
     modalOpen: false,
     addHostOpen: false,
     editHostOpen: false,
     settingsOpen: false,
     // ID of the account to be deleted
     deleteHostID: null,
     // Search bar
     searchQuery: null,
     //
     pendingEditResponse: true,
     editHost: null,
     hostStatus: [],
     pendingStatus: true
   },
   methods: {
     isUndefined(value) {
       return value === 'undefined' || value === 'null' || !value;
     },
     filterTags(value) {
       if (this.isUndefined(value)) {
          return null
       }
       else {
         return value.toString().split(",");
       }
     },
     orDefault(value) {
       if (this.isUndefined(value))
         return '-'
       else
         return value;
     },
     toggelDeleteModal(id) {
       this.modalOpen = !this.modalOpen
       this.deleteHostID = id
     },
     deleteServer() {
           var params = new URLSearchParams();
           params.append('id', this.deleteHostID);
           axios.post('/api/deleteserver', params)
               .then(response =>{
                   this.getServer()
               })
               .catch(function (error) {
                   console.log(error);
               });
       this.modalOpen = false
       this.deleteHostID = null
     },
     getServer() {
       axios
       .get('/api/listserver')
       .then(response => (
         this.hosts = response.data
       ))
     },
     getStatus(id) {
       this.pendingStatus = false;
       this.hosts.forEach(host => {
         var params = new URLSearchParams();
         params.append('id', host.id);
         axios.post('/api/getstatus', params)
             .then(response =>{
                 if(response.data == 1) {
                   this.hostStatus[host.id] = true;
                   return true;
                 }
                 else {
                   this.hostStatus[host.id] = false;
                   return false;
                 }
             })
             .catch(function (error) {
                 console.log(error);
             });
       });
     },
     // Check if the var is null and return an empty string
     // This avoids "null" in the HTML input fields when editing a host
     checkForValue(value) {
       if(value == "null") {
         return "";
       }
       else {
         return value;
       }
     },
     editServer(id) {
       this.editHostOpen = true;
       this.pendingEditResponse = true
       // Fetch the existing values
       var params = new URLSearchParams();
       params.append('id', id);
       axios.post('/api/showsingle', params)
       .then(response => (
         this.editHost = response.data,
         this.id = this.editHost.id,
         this.name = this.editHost.name,
         this.hostname = this.editHost.hostname,
        // Those vars might be null, so we have to check for the value
         this.location = this.checkForValue(this.editHost.location),
         this.tags = this.checkForValue(this.editHost.tags),
         this.ressources = this.checkForValue(this.editHost.ressources),
         this.provider = this.checkForValue(this.editHost.provider),
         this.type = this.checkForValue(this.editHost.type),
         this.os = this.checkForValue(this.editHost.os),
         this.ips = this.checkForValue(this.editHost.ips),
         this.price = this.checkForValue(this.editHost.price),
         this.notes = this.checkForValue(this.editHost.notes),
         this.pendingEditResponse = false
         ))
     },

     addServer(id) {
       if(this.name && this.hostname) {
         var params = new URLSearchParams();
         // Only append the ID if it was given => edit existing server
         if(id) {
          params.append('id', id);
         }
         params.append('name', this.name);
         params.append('hostname', this.hostname);
         params.append('location', this.location);
         params.append('tags', this.tags);
         params.append('ressources', this.ressources);
         params.append('provider', this.provider);
         params.append('type', this.type);
         params.append('os', this.os);
         params.append('ips', this.ips);
         params.append('price', this.price);
         params.append('notes', this.notes);
         axios.post('/api/addserver', params)
         .then(response =>{
             this.getServer();
             this.addHostOpen = false;
             this.editHostOpen = false;
             this.clearForm();
         })
         .catch(function (error) {
             console.log(error);
         });
       }
     },
     clearForm() {
       this.name = null;
       this.hostname = null;
       this.location = null;
       this.tags = null;
       this.ressources = null;
       this.provider = null;
       this.type = null;
       this.os = null;
       this.ips = null;
       this.price = null;
       this.notes = null;
     }
   },
   computed: {
     filteredHosts() {
       if(this.searchQuery) {
         return this.hosts.filter((host)=>{
           return this.searchQuery.toLowerCase().split(' ').every(v =>
             host.name.toString().toLowerCase().includes(v) ||
             host.hostname.toString().toLowerCase().includes(v) ||
             host.tags.toString().toLowerCase().includes(v) ||
             host.ressources.toString().toLowerCase().includes(v) ||
             host.location.toString().toLowerCase().includes(v) ||
             host.provider.toString().toLowerCase().includes(v) ||
             host.ips.toString().includes(v) ||
             host.type.toString().toLowerCase().includes(v) ||
             host.os.toString().toLowerCase().includes(v))
             //host.price.includes(v))
         })
       }
       else {
         return this.hosts;
       }
     }
   },
   mounted () {
     this.getServer();
     this.interval = setInterval(() => this.getServer(), 1000);
     this.getStatus;
     this.interval = setInterval(() => this.getStatus(), 10000);
   }
 })
