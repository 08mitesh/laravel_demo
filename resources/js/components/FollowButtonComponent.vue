<template>
    <div class="container">
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {

        props: ['userId','follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data : function(){
            return {
                status : this.follows
            }
        },
        methods:{
            followUser(){
                
                axios.post('/followUser/'+this.userId)
                .then(response => {
                   // console.log(response.data);
                   this.status = !this.status
                })
                .catch(error => {
                    if(error.response.status == 401)
                    {
                        window.location = '/login';
                    }
                })   
            }
        },

        computed:{
            buttonText(){
                console.log(this.status)
                return (this.status) ? 'Unfollow' : 'Follow'
            }
        }
        
    }
</script>
