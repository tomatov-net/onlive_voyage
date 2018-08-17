<template>
    <form method="POST" action="" enctype="multipart/form-data">
        <!--<div class="row">-->
            <!--<div class="col-md-10">-->
                <!--<div class="alert alert-danger alert-dismissible">-->
                    <!--<button type="button" aria-hidden="true" data-dismiss="alert" class="close">-->
                        <!--<span aria-hidden="true">&times;</span>-->
                    <!--</button>-->
                    <!--<span>{{ $error }}</span>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="row">-->
            <!--<div class="col-md-10">-->
                <!--<div class="alert alert-success alert-dismissible">-->
                    <!--<button type="button" aria-hidden="true" data-dismiss="alert" class="close">-->
                        <!--<span aria-hidden="true">&times;</span>-->
                    <!--</button>-->
                    <!--<span>{{ session('message') }}</span>-->
                <!--</div>-->
            <!--</div>-->

        <!--</div>-->
        <div class="form-group">
            <label for="">Название</label>
            <input v-validate="{ required: true, max:255 }" v-model="name" class="form-control" type="text"  name="name">
            <span class="text-danger" v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>
        <div class="form-group">
            <label for="">Описание</label>
            <textarea v-model="description" class="form-control" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="">Категория</label>
            <select v-validate="{ required: true}" name="category_id" v-model="category_id" class="form-control">
                <option value=""></option>
                <option v-for="category in categories_" :value="category.id">{{ category.name}}</option>
            </select>
            <span class="text-danger" v-show="errors.has('category_id')">{{ errors.first('category_id') }}</span>
        </div>
        <div class="form-group">
            <label for="">Производитель</label>
            <select v-validate="{ required: true}" name="manufacturer_id" v-model="manufacturer_id" class="form-control">
                <option value=""></option>
                <option v-for="manufacturer in manufacturers_" :value="manufacturer.id">{{ manufacturer.name}}</option>
            </select>
            <span class="text-danger" v-show="errors.has('manufacturer_id')">{{ errors.first('manufacturer_id') }}</span>
        </div>
        <div class="form-group">
            <label for="">Изображение</label>
            <input @change.prevent="processFile($event)" class="form-control" type="file" name="image" accept="image/*">
            <!--@isset($room->image)-->
            <img v-if="image" :src="image" alt="" class="img img-thumbnail">
            <!--@endisset-->
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
                // this.getBase64(event.target.files[0]);
                this.image = event.target.files[0];
            },

            getBase64(file) {
                var reader = new FileReader();
                var result = null;
                self = this;
                reader.readAsDataURL(file);
                reader.onload = function () {
                    console.dir(reader.result);
                    self.image = reader.result;
                };
                reader.onerror = function (error) {
                    console.log('Error: ', error);
                };

                return result;

            },

            validateForm() {
                let result = false;
                this.$validator.validateAll().then((result) => {

                    if (!this.errors.any()) {
                        result = true;
                    }
                    else{
                        result = false;
                    }
                });

                return result;
            },

            save(){
                var self = this;
                this.$validator.validateAll().then((result) => {

                    if (!this.errors.any()) {

                        let formData = new FormData();
                        formData.append('name', this.name);
                        formData.append('description', this.description);
                        formData.append('image', this.image);
                        formData.append('category_id', this.category_id);
                        formData.append('manufacturer_id', this.manufacturer_id);
                        formData.append('id', this.id);

                        if(this.id == ''){
                            axios.post('/medicines',
                                formData,
                            )
                            .then(function (response) {
                                window.location.href = "/medicines";
                            })
                            .catch(function (error) {
                                // handle error
                                console.log(error);
                                return;
                            })
                        }
                        else{
                            axios.post('/api/medicines/'+this.id,
                                formData,
                            )
                            .then(function (response) {
                                window.location.href = "/medicines";
                            })
                            .catch(function (error) {
                                // handle error
                                console.log(error);
                                return;
                            })


                        }
                    }
                });

            }
        }
    }
</script>

<style scoped>

</style>
