<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Главная страница</div>

                    <div class="card-body">
                        Баланс: {{ transactions.balance }}
                    </div>

                    <div>
                        <vue-good-table
                            :columns="columns"
                            :rows="transactions.transactions"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    data() {
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
    methods: {
        fetchTransactions() {
            axios.get('/api/transactions')
                .then(response => this.transactions = response.data)
                .catch(error => console.log(error))
        }
    },
    mounted() {
        this.fetchTransactions()
        window.setInterval(() => {
            this.fetchTransactions()
        }, 5000)
        console.log('Component mounted.')
    }


}
</script>
