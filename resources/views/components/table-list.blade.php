<script type="text/x-template" id="table-list">
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>

        <tr v-for="(data, index) in datas">
            <td>${data.id}</td>
            <td>${data.name}</td>
        </tr>
    </table>
</script>

<script>
    Vue.component('table-list', {
        template: '#table-list',
        delimiters: ['${', '}'],
        props: ['datas'],
        data() {
            return {

            }
        },
    })
</script>
