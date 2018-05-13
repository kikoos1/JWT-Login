<template>
    <v-container>
        <h1>Hello {{user.name}}</h1>
        <div v-if= '!confirm'>
        <v-alert type ='error' >Please confirm your email.Resend again</v-alert>
        </div>
        <div v-else>
        <v-alert type ='success' >Please confirm your email.Resend again</v-alert>
        </div>
    </v-container>
</template>

<script>
    export default {
        name: "Dashboard",
        data:()=>({
            user:[],
            confirm:false
        }),
        mounted:function(){
           this.user = this.$auth.user();
           if(this.user.isconfirm == 1){
               this.confirm = true;
           }
        }
    }
</script>

<style scoped>

</style>