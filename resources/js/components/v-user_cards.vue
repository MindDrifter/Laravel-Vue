<template>
    
    <div class="container  d-flex flex-row flex-wrap align-items-center">
        
            <h3 v-if="!cardExists && !loading">У вас еще нету карточек</h3>

             <div v-if="loading">
                <div class="loader">Loading...</div>
            </div>

        <div v-if="cardExists" class="card-group"></div>
                <div  v-for="card in cards" :key="card.body" class="card m-4 p-3 d-flex justify-content-center  align-items-center" style="max-width: 18rem; width: 100%; list-style: none">
                    <h3>{{card.title}}</h3>
                    <span>{{card.theme}}</span>
                    <span>{{card.body}}</span>

                    <span @click="deleteCard(card.id)" style="display: block" class="btn btn-danger">Удалить</span>
                </div>
            <!-- @endfor -->

            <div class="card m-4 p-3 d-flex justify-content-center  align-items-center" style="max-width: 18rem; width: 100%; list-style: none">
                <router-link class="btn btn-success" to="/user_cards/create_card">Добавить карту</router-link>
            </div>
    </div>

</template>

<script>
import axios from 'axios'
export default {
    data(){
        return{
            cardExists: false,
            loading:true,
            cards:''
        }
    },
    methods:{
        getCards(){
             axios.post('/api/user_cards', {
                email: localStorage.getItem('email'),
            },{headers:{
                'Content-Type': 'application/json'
            }}).then(response => {
                if (response.data[0]){
                    console.log(response.data);
                    this.cardExists = true
                    this.loading = false
                    this.cards = response.data
                }else{
                    this.loading = false
                    this.cardExists = false
                    this.cards = ''
                }
                
            })
        },

        deleteCard: function(id) {
            console.log(id);
            axios.post('http://127.0.0.1:8000/api/user_cards/delete_card',{
                id: id
            },{
                headers:{
                        'Content-Type': 'application/json'
                    }}).then(this.getCards())
            
        }
    },
    mounted:function(){
        this.getCards()
           
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