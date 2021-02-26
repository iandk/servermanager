var app = new Vue({
  el: '#app',
  data: {
    // Custom config
    currency: '€',
    billingTerm: 'month',
    // Form values
    hosts: [],
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
    // Search query 
    searchQuery: null,
    // Misc
    pendingEditResponse: true,
    editHost: null,
    hostStatus: [],
    pendingStatus: true,
    errors: []
  },
  methods: {
    // Check if value is undefined, null or not set
    isUndefined(value) {
      return value === 'undefined' || value === 'null' || !value;
    },
    // Split the tag array after each ","
    filterTags(value) {
      if (this.isUndefined(value)) {
        return null
      } else {
        return value.toString().split(",");
      }
    },
    // Return default value("-") when a value is undefined
    orDefault(value) {
      if (this.isUndefined(value)) {
        return '-';
      } else {
        return value;
      }
    },
    // Toggle the modal and set deleteHostID to the given ID
    toggelDeleteModal(id) {
      this.modalOpen = !this.modalOpen;
      this.deleteHostID = id;
    },
    // Delete server by the ID 
    deleteServer() {
      var params = new URLSearchParams();
      params.append('id', this.deleteHostID);
      axios.post('/api/deleteserver', params)
        .then(response => {
          this.getServer()
        })
        .catch(function (error) {
          console.log(error);
        });
      this.modalOpen = false;
      this.deleteHostID = null;
    },
    // Get all servers and assign the objects to the hosts array
    getServer() {
      axios
        .get('/api/listserver')
        .then(response => (
          this.hosts = response.data
        ))
    },
    // Get hosts status (ICMP ping) for the given ID
    // This method is called when mounted and has an interval 
    getStatus(id) {    
      this.hosts.forEach(host => {
        var params = new URLSearchParams();
        params.append('id', host.id);
        axios.post('/api/getstatus', params)
          .then(response => {
            if (response.data == 1) {
              this.hostStatus[host.id] = true;
              return true;
            } else {
              this.hostStatus[host.id] = false;
              return false;
            }
          })
          .catch(function (error) {
            console.log(error);
          });
          this.pendingStatus = false;
      });
    },
    // Check if the var is null and return an empty string
    // This avoids "null" in the HTML input fields when editing a host
    checkForValue(value) {
      if (value == "null") {
        return "";
      } else {
        return value;
      }
    },

    // Edit an existing server
    // - Open UI Sidebar
    // - Set response to pending while waiting
    // - Fetch the existing host data
    editServer(id) {
      this.editHostOpen = true;
      this.pendingEditResponse = true
      // Fetch the existing values
      var params = new URLSearchParams();
      params.append('id', id);
      axios.post('/api/getvalues', params)
        .then(response => (
          this.editHost = response.data,
          this.id = this.editHost.id,
          this.name = this.editHost.name,
          this.hostname = this.editHost.hostname,
          // Those vars might be null, so we have to check for their value
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
    // Add/ edit existing server
    // This method will add or edit an host depending on whether an id is passed.
    // No ID? => Add new server
    // Passed ID? => Edit existing and keep the ID+
    addServer(id) {
      // Throw error if mandatory fields are empty
      if (!this.name || this.name == "" || !this.hostname || this.hostname == "") {
        this.throwError("Please fill out all required fields");
        return;
      }
      // Throw error if price is not numeric
      if (isNaN(this.price)) {
        this.throwError("The price only allowes numbers!");
        return;
      }
      var params = new URLSearchParams();
      // Only append the ID if it was given => edit existing server
      if (id) {
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
        .then(response => {
          this.getServer();
          this.addHostOpen = false;
          this.editHostOpen = false;
          this.clearForm();
          this.clearErrors();
        })
        .catch(function (error) {
          console.log(error);
        });

    },
    // Add error message to the errors array if the message doesnt exist yet
    throwError(message) {
      if (this.errors.indexOf(message) === -1) this.errors.push(message);
    },
    // Remove all existing errors
    clearErrors() {
      this.errors = [];
    },
    // Reset and close form
    cancelForm(flag) {
      this.clearForm();
      return !flag;
    },
    // Clear form
    clearForm() {
      this.name = "";
      this.hostname = "";
      this.location = "";
      this.tags = "";
      this.ressources = "";
      this.provider = "";
      this.type = "";
      this.os = "";
      this.ips = "";
      this.price = "";
      this.notes = "";
    }
  },
  computed: {
    // Only return hosts that match the search query
    filteredHosts() {
      if (this.searchQuery) {
        return this.hosts.filter((host) => {
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
      } else {
        return this.hosts;
      }
    }
  },
  mounted() {
    this.getServer();
    this.getStatus();
    this.interval = setInterval(() => this.getServer(), 1000);
    this.interval = setInterval(() => this.getStatus(), 10000);
  }
})