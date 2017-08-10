<template>

    <div class="timesheet-generator">
        <form action="/api/timesheet/download" method="post" novalidate>
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" class="form-control" v-model="form.company" name="company">
            </div>
            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" class="form-control" v-model="form.name" name="name">
            </div>
            <div class="form-group">
                <label>Starting Date</label>
                <input type="text" class="form-control" id="start_date" v-model="form.date" name="date">
            </div>
            <hr>
            <h4>Options</h4>

            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="form.hide_saturday" name="hide_saturday"> Hide Saturday
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="form.hide_sunday" name="hide_sunday"> Hide Sunday
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Download PDF</button>
            </div>
        </form>

        <h3>Preview Timesheet</h3>
        <hr>

        <div class="ts-preview" v-html="timesheet_preview">
        </div>

    </div>

</template>

<script>
    export default {
        data(){
            return {
                form: {
                    name: '',
                    date: '',
                    company: '',
                    hide_sunday: false,
                    hide_saturday: false
                },
                timesheet_preview: ''
            }
        },
        mounted() {
            this.getPreview();

            var datepicker = new Pikaday({
                field: document.getElementById('start_date'),
                format: 'MMMM D, YYYY',
                onSelect: (date) => {
                    this.$data.form.date = datepicker.toString();
                }
            });
        },
        methods: {
            getPreview: _.debounce(
                function() {
                    axios.post('/api/timesheet/preview', this.form).then(res => {
                        this.$data.timesheet_preview = res.data;
                    });
                },
                500
            )
        },
        watch: {
            form: {
                handler: function (value) {
                    this.getPreview();
                },
                deep: true
            }
        }
    }
</script>


<style lang="scss">
    .ts-preview{
        max-width: 1076px;
        border: 1px solid black;
        padding: 10px;
        color: black;
        overflow-x: scroll;
    }
</style>