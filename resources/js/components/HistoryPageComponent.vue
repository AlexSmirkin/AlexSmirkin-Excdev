<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">История операций</div>
                    <div>
                        <vue-good-table
                            :columns="columns"
                            :rows="transactions"
                            :search-options="{
                                enabled: true,
                                placeholder: 'Найти',
                            }"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    data: function () {
        return {
            columns: [
                {
                    label: 'Id',
                    field: 'id',
                    type: 'number',
                },
                {
                    label: 'Сумма',
                    field: 'amount',
                    type: 'number',
                },
                {
                    label: 'Описание',
                    field: 'description',
                },
                {
                    label: 'Дата',
                    field: 'created_at',
                    type: 'datetime',
                    inputFormat: 'DD-MM-YYYY HH:mm:ss',
                    outputFormat: 'DD-MM-YYYY HH:mm:ss',
                    sortFn(a, b) {
                        console.log(a)
                        console.log(b)
                        let dateA = moment(a, 'DD-MM-YYYY HH:mm:ss');
                        let dateB = moment(b, 'DD-MM-YYYY HH:mm:ss');
                        console.log(dateA)
                        console.log(dateB)
                        return dateA >= dateB ? 1 : -1;
                    },
                },
            ],
            transactions: []
        }
    },
    created() {
        axios.get('/api/transactions/data').then(response => {
            this.transactions = response.data.data;
            console.log(response.data)
        }).catch((error) => {
            console.log(error);
        });
    }
};
</script>
