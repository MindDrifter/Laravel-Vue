<template>
    <div>
        <form method="post" @submit.prevent="logIn" style="display: flex; flex-direction: column; align-items: center;">
        <input class = "input-group-text m-3" type="email" name="email" id="email" v-model="email" placeholder="Введите почту">
        <input class = "input-group-text m-3"  type="password" name="password" v-model="password" id="password" placeholder="Введите пароль">
        <button class="btn btn-success" type="submit">Войти</button>
    </form>
    </div>
</template>

<script>
import axios from 'axios'
import {email, required, minLength} from 'vuelidate/lib/validators'

export default {
    data(){
        return{
            password:'',
            email:''
        }
    },

    methods:{
        logIn: function(){
            axios.post('api/login/success', {
                password: this.password,
                email: this.email,
            }, {headers:{
                'Content-Type': 'application/json'
            }}).then (response => {
                if (response.data.email && response.data.id){
                    localStorage.setItem('id', response.data.id)
                    localStorage.setItem('email', response.data.email)
                    this.$emit('logIn')
                    }
            })
        }
    },
    watch:{

    }
}
</script>