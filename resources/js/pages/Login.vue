<template>
    <div class="login-st container-fluid">
        <div class="row justify-content-center vertical-center">
            
                <form class='col-12 col-md-6 col-lg-4 p-5' v-on:submit.prevent='onSubmit'>
                    <div class="alert alert-danger mb-0" v-if="errors.length">
                        <ul>
                            <li v-for='(error, index) in errors' :key='index'>{{ error }}</li>
                        </ul>
                    </div>
                    <div class='form-group'>
                        <h3>Login</h3>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input v-model='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input v-model='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-primary" >
                        Login
                    </button>
                </form>
                
        </div>
        
    </div>
</template>
<script>
export default {
    name: 'login',
    data(){
        return{
            email: '',
            password: '',
            errors: []
        }
    },
    methods:{
       onSubmit()
       {
           this.errors = []
           if (!this.email)
           {
               this.errors.push('Email is required.')
           }else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))
           {
               this.errors.push('You have entered an invalid email address!')
           }
           
           if(!this.password)
           {
               this.errors.push('Password is required.')
           }

           if(this.password.length < 8)
           {
               this.errors.push('Passwords must contain at least 8 characters')
           }

           if(!this.errors.length)
           {
               const data = {
                   email: this.email,
                   password: this.password
               }

               
                axios.post("api/auth/login", data)
                .then(response => { 
                    const token = localStorage.setItem('token', response.data.access_token)
                    const user = localStorage.setItem('user', response.data.user)
                    this.$router.push("/");

                }).catch(error => {
                    this.errors.push(error.message)
                })
           }
       }
    }
}
</script>
<style lang="scss" scoped>
.login-st {
    background: url('/imgs/login-background.jpg');
    background-size: cover;
}

.vertical-center{
    min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
    min-height: 100vh;
    display: flex;
    align-items: center;
}

form{
    background: #ffffff96;
    box-shadow: 1px 1px 1px 1px #212529;
    border-radius: 3%;
}

</style>