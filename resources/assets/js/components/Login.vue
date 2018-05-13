<template>
    <v-container>
        <form @submit.prevent = 'Login'>
        <v-text-field
        type = 'email'
        v-model = 'email'
        ></v-text-field>
        <v-text-field
        type = 'password'
        v-model = 'password'>
        </v-text-field>
            <v-btn type = 'submit'>Login</v-btn>
        </form>
        <a href=""><i class="fab fa-facebook-f fa-lg" size:7x></i></a>
        <a href="/auth/google"><i class="fab fa-google-plus"></i></a>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data:()=>({
            email:'',
            password:'',
            succ:false,
            error:false,
            errors:[]
        }),
        methods:{
            Login(){
                var app = this;
                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                        app.succ = true;
                    },
                    error: function (resp) {
                        app.error = true;
                        app.erros = resp;
                    },
                    rememberMe: true,
                    redirect: '/dashboard',
                    fetchUser: true,
                });
            }
        }
    }
</script>

<style scoped>

</style>