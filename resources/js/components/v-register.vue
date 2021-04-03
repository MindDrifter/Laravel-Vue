<template>

    <div>

        <form method="post" @submit.prevent="register"  style="display: flex; flex-direction: column; align-items: center;">

            <div class="error" v-if="!$v.email.required && $v.email.$dirty">Email is required</div>
            <div class="error" v-if="!$v.password.required && $v.password.$dirty">Password is required</div>
            <div class="error" v-if="!$v.password.minLength && $v.password.$dirty">Password less then 5 chars</div>
            <div class="error" v-if="emailExist && $v.password.$dirty">Такая почта уже зарегестрирована</div>
            <div class="error" v-if="registerSuccess && $v.password.$dirty">Вы успешно зарегестрировались</div>

            <input  v-model.trim="$v.email.$model" class = "input-group-text m-3" type="email" name="email" id="email" placeholder="Введите почту">
            <input v-model.trim="$v.password.$model" @input="preventTouch" class = "input-group-text m-3" type="password" name="password" id="password" placeholder="Введите пароль">
            <button class="btn btn-success"  type="submit">Зарегестрироваться</button>
        </form>


    </div>

</template>

<script>

import {email, required, minLength} from 'vuelidate/lib/validators'
    export default {
        data(){
            return{
                password:'',
                email:'',
                emailExist:false,
                registerSuccess: false

            }
        },
        methods:{
            preventTouch() {
                this.$v.$reset()
            },


            register(){
                this.$v.$touch()
                if (!this.$v.email.invalid && !this.$v.password.invalid){

                    axios.post('api/register/checkEmail ', {
                        email: this.email
                    }, { headers:{
                            'Content-Type': 'application/json'
                        }}).then(response => {
                            if (response.data === true){
                                this.emailExist = false

                                axios.post('api/register/success ', {
                                    email: this.email,
                                    password: this.password
                                }, { headers:{
                                        'Content-Type': 'application/json'
                                    }}).then(()=>{
                                    this.registerSuccess = true
                                })
                            }if (response.data === false) {
                                this.emailExist = true
                            }
                    })
                }
            }
        },

        watch:{
        },
        validations:{
            email:{
                email,
                required,
            },
            password:{
                required,
                minLength: minLength(5)
            }
        }



    }
</script>
