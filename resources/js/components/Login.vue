<template>
    <div id="login">
        <h1>Login</h1>
        <input type="text" name="email" v-model="input.email" placeholder="Email" />
        <input type="password" name="password" v-model="input.password" placeholder="Password" />
        <button type="button" v-on:click="login()">Login</button>
        <text>Or</text>
        <router-link to="/register" class="nav-item nav-link">Register</router-link>
    </div>
</template>

<script>
    export default {
        name: 'Login',
        data() {
            return {
                input:{}
            }
        },
        methods: {
            login() {
                console.log("Data :" , this.input)
                this.axios
                    .post('http://localhost:8000/api/auth/login', JSON.stringify(this.input) ,{
                        headers:{ 
                            'Content-Type':'application/json'
                        }
                    })
                    .then(async (response )=> {
                        
                        console.log(response.data)
                        await localStorage.setItem("auth_token" , response.data)
                        await console.log("Access" , localStorage.getItem("auth_token"))
                        if(response.data!=null){
                            this.$router.push({name: 'home'})
                        }
                        else{
                            alert("Email/password wrong")
                        }
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>

<style scoped>
    #login {
        width: 500px;
        border: 1px solid #CCCCCC;
        background-color: #FFFFFF;
        margin: auto;
        margin-top: 200px;
        padding: 20px;
    }
</style>