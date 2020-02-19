<template>  
       <div class='container mt-3'>
           <div class="row justify-content-md-center">
               <!-- Individual -->
               <div class="col-3 card individual bg-danger text-white text-center">
                    <div class="card-body">
                        <router-link class="btn btn-primary card-title" to='/individual'>
                            <i class="fas fa-user"></i> Individual <span class="badge badge-light">4</span>
                        </router-link>
                        <p class="card-text">Name, address, phone, email and other information</p>
                    </div>
                </div>
                <!-- family -->
                <div class="col-3 card family bg-success text-white text-center">
                    <div class="card-body">
                        <router-link type="button" class="btn btn-primary card-title" to='/family'>
                            <i class="fas fa-users"></i> Family <span class="badge badge-light">4</span>
                        </router-link>
                        <p class="card-text">Family information eg: Date of marriage </p>
                    </div>
                </div>
           </div>
           <!-- excel -->
           <div class="row justify-content-md-center my-3">
               <!-- import -->
               <div class="col-3 card excel bg-secondary text-white text-center">
                   <div class="card-body">
                       <router-link type="button" class="btn btn-dark card-title" to='/import-excel'>
                            <i class="fas fa-upload"></i> Import excel 
                        </router-link>
                        <p class="card-text">Upload execl file and insert data to system </p>
                   </div>
               </div>
               <div class="col-3 card excel bg-secondary text-white text-center">
                   <div class="card-body">
                       <router-link type="button" class="btn btn-warning card-title" to='/export-excel'>
                            <i class="fas fa-download"></i> Export excel 
                        </router-link>
                        <p class="card-text">Download execl file has data</p>
                   </div>
               </div>

           </div>
       </div>
</template>

<script>

export default {
    name:'home',
    components: {
        
    }
}
</script>

<style>
    .card{
        margin-left: 10px;
        }
</style>