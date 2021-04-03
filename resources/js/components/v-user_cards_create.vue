<template>
    <div>
        <form method="post" @submit.prevent="chechValid" style="display: flex; flex-direction: column; align-items: center;">
            <span class="error" v-if="$v.theme.$dirty && !$v.theme.required"> Введите тему </span>
            <span class="error" v-if="$v.theme.$dirty && !$v.theme.minLength && $v.theme.required"> Тема должна быть длиннее 5 символов </span>
            
            <span class="error" v-if="$v.title.$dirty && !$v.title.required"> Введите название </span>
            <span class="error" v-if="$v.title.$dirty && !$v.title.minLength"> название должно быть длиннее 5 символов </span>
           
            <span class="error" v-if="$v.body.$dirty && !$v.body.required"> Введите текст </span>
            <span class="error" v-if="$v.body.$dirty && !$v.body.minLength"> Текст должен быть длиннее 5 символов </span>
           
            
            <input v-model="theme" type="text" name="theme" id="theme" placeholder="Введите тему карты">
            <input v-model="title" type="text" name="title" id="title" placeholder="Введите название карты">
            <input v-model="body" type="text" name="body" id="body" placeholder="Введите название карты">
            <button class="btn btn-success" type="submit">Добавить карту</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
import {required, minLength} from 'vuelidate/lib/validators'
export default {
    data(){
        return{
            theme:'',
            title:'',
            body:'',
            id: localStorage.getItem('id')
        }
    },
    methods:{
        chechValid(){
            this.$v.$touch()
            if (!this.$v.title.$invalid && !this.$v.body.$invalid && !this.$v.theme.$invalid) {
                axios.post('http://127.0.0.1:8000/api/user_cards/add_card/confirm',{
                    theme: this.theme,
                    title: this.title,
                    body: this.body,
                    id: this.id
                },{
                    headers:{
                        'Content-Type': 'application/json'
                    }}).then(this.$router.push('/user_cards'))
            }
        }
    },
    watch:{
        theme(){
            console.log(this.theme);
        }
    },
    validations:{
        theme:{
            required,
            minLength: minLength(5)
        },
        title:{
            required,
            minLength: minLength(5)
        },
        body:{
            required,
            minLength: minLength(5)
        }
    }
    
}
</script>