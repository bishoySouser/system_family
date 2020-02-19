<template>
    <div class='container-fluid p-0'>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link to='/' class="nav-link">
                        Home
                    </router-link>
                </li>
                <li class='nav-item'>
                    <router-link to='/individual' class="nav-link">
                        Inividual
                    </router-link>
                </li>
                <li class='nav-item'>
                    <router-link to='/family' class="nav-link">
                        Family
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    
                    <a class="dropdown-item" @click='logout' href="javascript:;">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'navbar',
    props: ['app'],
    date() {
        return {

        }
    },
    methods: {
        logout(){
            // axios.post('api/auth/logout').then((res) => {
            //     console.log(res.data)
            //     // this.$router.push('/login')
            // })
            localStorage.removeItem('token')
            this.$router.push('/login');
        }
    }
}
</script>

<style>

</style>