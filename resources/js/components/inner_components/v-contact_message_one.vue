<template>
    <div>


        <ul v-for="message in messages" :key="messages.name" >
            <!--            <?php-->
            <!--        $d = file_get_contents("https://jsonplaceholder.typicode.com/posts");-->
            <!--        $d = json_decode($d, true);-->
            <!--        print_r($d[0]["title"])-->
            <!--            ?>-->


            <li style="width: 500px" class="card-group container " v-if="messages !== null && loading === false">
                <div  class="card m-3 ">

                    <span class="card-title">{{message.name}} </span>
                    <span class="card-text p-3">{{message.mail}} </span>
                    <span class="card-body p-3">{{message.area}} </span>
                    <div class="card-footer">
                        <router-link class="btn" to="/">Редактировать</router-link> <span class="btn btn-danger" @click="deleteMessage(message.id)">Удалить</span>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</template>


<script>
 export default {
     props:['messages', 'loading'],

     mounted() {

     },

     computed:{

     },
     methods:{
         deleteMessage: function (id) {
             this.$emit('deleteMessage', id);
         }
     }

 }


</script>
