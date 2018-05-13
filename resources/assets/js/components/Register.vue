<template>
    <div>
    <v-container xs>
        <form @submit.prevent = 'Register'>
        <v-text-field
            type = 'text'
            v-model = 'name'
            required
            label = 'Name'
        ></v-text-field>
        <v-text-field
                type = 'email'
                v-model = 'email'
        ></v-text-field>
            <v-text-field
                    type = 'password'
                    v-model = 'password'
            ></v-text-field>
            <v-btn type = 'submit'>Register</v-btn>
            </form>
        <h1>Register with</h1>
        <a href="/auth"><i class="fab fa-facebook-f"></i></a>
        <a href="auth/google"><i class="fab fa-google-plus"></i></a>
    </v-container>
   <v-container>

                   <v-alert type = 'error' v-show = 'error'>{{errors.email}}</v-alert>

   </v-container>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data:()=>({
            name:'',
            email:'',
            password:'',
            succ:false,
            error:false,
            errors:[]
        }),
        methods:{
            Register(){
                var app = this;
                this.$auth.register({
                    data: {
                        name:app.name,
                        email:app.email,
                        password:app.password
                    }, // data: {} in Axios
                    success: function () {
                        app.succ = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                        console.log(resp.response.data.errors);
                        console.log(app.errors);
                    },
                    autoLogin: true,
                    rememberMe: true,
                    redirect: '/dashboard'
                });
            }
        }
    }
</script>

<style scoped>

</style>