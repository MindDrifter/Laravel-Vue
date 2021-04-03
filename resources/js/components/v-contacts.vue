<template>
    <div>
        <h1>Contacts</h1>

        <alert_message :fail="fail" :success="success" :message="message" ></alert_message>

        <form  @submit.prevent="sendData" style="display: flex; flex-direction: column; align-items: center;">
            <input v-model="name" class="input-group-text m-3" type="text" name="name" id="name" placeholder="Введите имя" >
            <input v-model="email" class="input-group-text m-3" type="email" name="mail" id="mail" placeholder="Введите mail" >
            <div class="form-floating">
                <textarea v-model="area" class="form-control"  style="resize: none; height: 300px; width: 400px;" name="area" id="area" ></textarea>
                <label for="area">Сообщение</label>
            </div>
            <button type="submit" >Подтвердить</button>
        </form>

    </div>
</template>

<script>
import alert_message from "./inner_components/alert_message";


    export default {
        components:{
            alert_message
        },

        data(){
            return{
                name:'',
                email:'',
                area:'',

                fail: false,
                success: false,
                message:'',
                valid: false
            }
        },
        methods:{
          sendData: function (){

              if (this.name.length > 0 && this.area.length > 0 && this.email.length > 0){
                  this.valid = true
                  this.fail = false
                  this.success = true
                  this.message = 'Вы успешно добавили сообщение'
                    // let data = JSON.stringify({
                    //     name: this.name,
                    //     area: this.area,
                    //     mail: this.email})

                  axios.post('api/contact/submit', {
                      name: this.name,
                      area: this.area,
                      mail: this.email
                  }, { headers:{
                          'Content-Type': 'application/json'
                      }})

              }

              if (this.valid === false  && this.name.length === 0 && this.area.length === 0){
                  this.fail = true
                  this.message = 'Вы не ввели имя и сообщение'
              } else {
                      if (this.email.length === 0){
                          this.fail = true
                          this.message = 'Вы не ввели почту'
                      }

                      if (this.valid === false  && this.name.length === 0 ){
                          this.fail = true
                          this.message = 'Вы не ввели имя'
                      }

                      if (this.valid === false  && this.area.length === 0 ){
                          this.fail = true
                          this.message = 'Вы не ввели сообщение'
                      }
              }
          }
        },
        watch:{
            area: function (){
                console.log(this.area)
            },
            name: function (){
                console.log(this.name)
            }
        }
    }

</script>
