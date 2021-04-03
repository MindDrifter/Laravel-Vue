<template>

    <div>
        <span v-if="success === true">Alert:{{message}}</span>
        <span v-if="fail === true">Alert:{{message}}</span>
    </div>

</template>

<script>
    export default {

        props:['fail', 'success', 'message'],

        data(){

            return{

            }
        },

        methods:{
            showMessage: function (messageType, message){
                if(messageType === 'fail'){
                    this.fail = true
                    this.message = message

                }
                if (messageType === 'success'){
                    this.success === true
                    this.message = message
                }
            },
        },
        mounted() {
            if (this.isMessage === false){
                this.fail=this.seccess=false
            }
        }
    }
</script>
