<template>
    <div id="login">
        <h1>Register</h1>
        <input type="text" name="username" v-model="input.name" placeholder="Username" />
        <input type="text" name="email" v-model="input.email" placeholder="Email" />
        <input type="password" name="password" v-model="input.password" placeholder="Password" />
        <button type="button" v-on:click="register()">Register</button>
        <text>Or</text>
        <router-link to="/" class="nav-item nav-link">Login</router-link>
    </div>
</template>

<script>
    export default {
        name: 'Login',
        data() {
            return {
                input: { }
            }
        },
        methods: {
            register() {

                console.log("Data :" , this.input)
                this.axios
                    .post('http://localhost:8000/api/auth/register', this.input ,{
                        headers:{
                            // 'Accept':'application/json',
                            'Content-Type':'application/json'
                        }
                    })
                    .then(async(response) => {
                        // response.json()
                        console.log(response.data)
                        await localStorage.setItem("auth_token" , response.data)
                        await console.log("Access" , localStorage.getItem("auth_token"))
                        if(response.data!=null){
                            this.$router.push({name: 'home'})
                        }
                        else{
                            alert("Email/password wrong")
                        }
                        console.log("Response : " ,response.data)
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