<template>
    <div>
        <v_header :email = "email" :logged="logged" @logOut="logOutMain" ></v_header>
        <router-view @logIn="logInMain" ></router-view>
    </div>
    
</template>

<script>
import v_header from "./v-header.vue"

export default {
    components:{
        v_header
    },

  data(){
      return{
          logged:null,
          email: null
      }
  },

  methods:{
    logOutMain: function(){
        console.log('1');
        localStorage.removeItem('email')
        localStorage.removeItem('password')
        this.logged = false;
    },
    logInMain: function(){
        this.logged = true
        this.email = localStorage.getItem('email')
    },
    checkAuth: function(){
        if (localStorage.getItem('email')) {
            this.logged = true
            this.email = localStorage.getItem('email')
        }
    }
  },
  mounted: function(){
      this.checkAuth()
  }
}
</script>