<template>
    <div>
        <h1>All messages</h1>

        <one_message :messages="messages" :loading="loading" @deleteMessage="deleteMessage"></one_message>

            <div v-if="loading">
                <div class="loader">Loading...</div>
            </div>

            <div v-if="loading === false && messages.length < 1">
                <h3>Сообщений нет</h3>
            </div>



    </div>
</template>

<script>
import one_message from './inner_components/v-contact_message_one';
import alert_message from "./inner_components/alert_message";
import axios from 'axios';



    export default {
        components:{
            one_message
        },

        methods:{
           //  deleteCookie:function (name){
           //      document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"
           //  }
           // ,
           //  getCookie: function (name){
           //          let a = document.cookie.split(';').map(cookie => cookie.split('='))
           //          for (let i = 0; i < a.length; i++){
           //              if (a[i][0].includes(name)){
           //                  console.log(a[i][1])
           //                  return a[i][1]
           //              }
           //          }
           //      }
           //  },
           //

            getMessages: function () {

                axios.get('/api/contact_messages')
                    .then((response) => {
                        this.messages = response.data
                        this.loading = false})
                    .catch(err => console.log(err))
            },

            deleteMessage: function (id){
                this.loading = true
                axios.get('/api/contact_message_delete/'+id).catch(err => console.log(err))
                axios.get('/api/contact_messages')
                    .then((response) => {
                        this.messages = response.data
                        this.loading = false})
                    .catch(err => console.log(err))
            }
        },

        data(){
            return{
                loading: true,
                messages: null
            }
        },

        computed: {



        },

        mounted() {
            this.getMessages()




        }
    }
</script>

<style scoped>

    .loader,
    .loader:after {
        border-radius: 50%;
        width: 10em;
        height: 10em;
    }
    .loader {
        margin: 60px auto;
        font-size: 10px;
        position: relative;
        text-indent: -9999em;
        border-top: 1.1em solid rgba(255, 255, 255, 0.2);
        border-right: 1.1em solid rgba(255, 255, 255, 0.2);
        border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
        border-left: 1.1em solid #3956e9;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation: load8 1.1s infinite linear;
        animation: load8 1.1s infinite linear;
    }
    @keyframes load8 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style>
