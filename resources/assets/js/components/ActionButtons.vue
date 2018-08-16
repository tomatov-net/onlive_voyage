<template>
    <div>
        <a class="btn btn-info" :href="edit">Изменить</a>
        <a class="btn btn-danger" @click.prevent="deleteEntity" href="#">Удалить</a>
    </div>
</template>

<script>
    export default {
        name: "ActionButtons",
        props:['edit', 'delete'],
        data(){
            return {
                editLink_: '',
                deleteLink: '',
            }
        },
        created(){
            this.editLink_ = this.edit;
            this.deleteLink = this.delete;
        },
        methods:{
            deleteEntity(){
                if(confirm('Удалить запись?')){
                    axios({
                        url:this.deleteLink,
                        method:'delete',
                    }).catch(function (error) {
                        console.log(error);
                        return;
                    }).then(function (response) {
                        window.location.href = "/medicines";
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
