<template>
    <div class="col-md-12">
        <div class="form-group">
            <p>{{message}}</p>
        </div>
        <div class="form-group">
            <input v-model="number1" type="number" class="form-control" placeholder="Число1">
        </div>
        <div class="form-group">
            <select class="form-control" v-model="operation" name="" id="">
                <option v-for="operation in operations" :value="operation">{{ operation }}</option>
            </select>
        </div>
        <div class="form-group">
            <input v-model="number2" type="number" class="form-control" placeholder="Число2">
        </div>
        <div class="form-group">
            <p>Вычисление на клиенте</p>
            <input v-model="computed_result" type="text" disabled class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <p>Вычисление на сервере</p>
            <input v-model="ajax_result" type="text" disabled class="form-control" placeholder="">
        </div>
    </div>
</template>

<script>
    export default {
        name: "Calc",
        data() {
            return {
                number1: '',
                number2: '',
                result: '',
                operations: [
                    '*',
                    '/',
                    '-',
                    '+',
                ],
                operation:'',
                ajax_result:'',
                message:'',
            }
        },
        computed:{
            computed_result: function(){
                this.calculate();
                if(this.operation == '*'){
                    return this.number1 * this.number2;
                }
                else if(this.operation == '/'){
                    return this.number1 / this.number2;
                }
                else if(this.operation == '-'){
                    return this.number1 - this.number2;
                }
                else if(this.operation == '+'){
                    return parseInt(this.number1) + parseInt(this.number2);

                }
            }
        },
        methods:{
            calculate(){
                var self = this;
                axios.post('/api/calculate', {
                    number1: self.number1,
                    number2: self.number2,
                    operation: self.operation,
                }).then(function (r) {
                    let data = r.data;
                    console.dir(data)
                    self.ajax_result = data.result;
                    self.message = data.message;
                })
            }
        }
    }
</script>

<style scoped>

</style>
