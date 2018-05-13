<template>
    <v-app>
        <v-navigation-drawer app>
            <v-list dense class="pt-0">
                <v-list-tile   v-if = '!$auth.check()' to = '/register'>
                    <v-list-tile-action >
                        <v-icon>input</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content >
                        <v-list-tile-title ><span>Register</span></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile  v-if = '!$auth.check()'to = '/login'>
                    <v-list-tile-action >
                        <v-icon>account_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content >
                        <v-list-tile-title ><span>Login</span></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile  v-if = '$auth.check()'to = '/login'>
                    <v-list-tile-action >
                        <v-icon>account_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content >
                        <v-list-tile-title @click.prevent="$auth.logout()"><span>Logout</span></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app></v-toolbar>
        <v-content>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>