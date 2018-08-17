<template>
    <form method="POST" action="">
        <div class="form-group">
            <label for="">Name</label>
            <input v-model="name" class="form-control" type="text"  name="name">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea v-model="description" class="form-control" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="">Category</label>
            <select name="category_id" v-model="category_id" class="form-control">
                <option value=""></option>
                <option v-for="category in categories_" :value="category.id">{{ category.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Manufacturer</label>
            <select name="manufacturer_id" v-model="manufacturer_id" class="form-control">
                <option value=""></option>
                <option v-for="manufacturer in manufacturers_" :value="manufacturer.id">{{ manufacturer.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input @change.prevent="processFile($event)" class="form-control" type="file" name="image" accept="image/*">
            <img v-if="image" :src="image" alt="" class="img img-thumbnail">
        </div>
        <div class="col-md-12">
            <button class="btn btn-info" @click.prevent="save" type="submit">Сохранить</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "Form",
        props:{
            categories_:null,
            manufacturers_:null,
            name_: '',
            description_: '',
            image_: '',
            category_id_: '',
            manufacturer_id_: '',
            id_: ''
        },
        data(){
            return{
                name: '',
                description: '',
                image: '',
                category_id: '',
                manufacturer_id: '',
                id: '',
                categories: null,
                manufacturers: null
            }
        },
        created(){
            this.manufacturers = this.manufacturers_;
            this.categories = this.categories_;
            this.name = this.name_;
            this.description = this.description_;
            this.image = this.image_;
            this.category_id = this.category_id_;
            this.manufacturer_id = this.manufacturer_id_;
            this.id = this.id_;
        },
        methods:{
            processFile(event) {
                this.image = event.target.files[0];
            },

            save(){

                let formData = new FormData();
                // const config = { headers: { 'content-type': 'multipart/form-data' } };
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('image', this.image);
                formData.append('category_id', this.category_id);
                formData.append('manufacturer_id', this.manufacturer_id);
                formData.append('id', this.id);

                axios.post('/test/medicines/'+this.id,
                    formData,
                )


            }
        }
    }
</script>

<style scoped>

</style>
