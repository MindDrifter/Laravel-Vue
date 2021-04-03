<template>
    <div>
        <div  class="navbar  navbar-dark bg-dark">

        <div  class="container  collapse navbar-collapse" id="navbarSupportedContent">
            <ul style="list-style: none" class="d-flex justify-content-around  align-items-center" >

                <li class="nav-item"><router-link class="nav-link" to="/">Главная</router-link></li>
                <li class="nav-item"><router-link class="nav-link" to="/contact"> Контакты</router-link></li>
                <li class="nav-item"><router-link class="nav-link" to="/contact_messages">Все сообщения</router-link></li>


                   <li v-if="logged === true" class="nav-item" ><router-link class="nav-link" to="/user_cards">Мои карты</router-link></li>

                   <li v-else class="nav-link" style="padding-right: 30em"><router-link class="" style="text-decoration: none" to="/">Войдите</router-link>
                       <span style="color: white;">или</span>
                       <router-link style="text-decoration: none"  to="/register">Зарегестрируйтесь</router-link> <span style="color: white"><br>, чтобы управлять карточками</span>
                   </li>



                <div  v-if="logged" class="d-flex flex-column" style="padding-left: 40em">
                    <span style="color: white; text-align: center"> {{email}} </span>
                    <a class="nav-item nav-link" @click="logOut">Выйти</a>
                </div>

                <div v-if="!logged">
                    <router-link class="nav-item nav-link" to="/login" >Войти</router-link>
                    <router-link class="nav-item nav-link" to="/register">Регистрация</router-link>
                </div>


            </ul>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['logged', 'email'],

        data(){
            return{
                // email:''
            }
        },

        methods:{
            logOut:function(){
                console.log('asdasd');
                this.$emit('logOut')
            }
            // setCookie: function(){
            //     localStorage.setItem('email', '23')
            //     localStorage.setItem('password', 'asdasd')
            //     this.email = localStorage.getItem('email')
            //     this.logged = true;
            // },
            // deleteCookie:function (){
            //     localStorage.removeItem('email')
            //     localStorage.removeItem('password')
            //     this.logged = false;
            //      },
            // getCookie: function (){
            //     if(localStorage.getItem('email') && localStorage.getItem('password')){
            //         this.logged = true;
            //         this.email = localStorage.getItem('email')
            //     }
            // }
        },
        mounted() {
        }


    }
</script>
