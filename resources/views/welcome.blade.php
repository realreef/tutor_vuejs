<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->
    <style>
      body {
        font-family: 'Nunito', sans-serif;
      }
      .red {
        color: #ff0000;
      }
    </style>
  </head>
  <body class="antialiased">

    <div id="app">
        {{-- data binding (one way) --}}
        ${message}

        {{-- attribute binding --}}
        {{-- <span v-bind:class="color">${message}</span> --}}

        {{-- two way binding --}}
        {{-- <input v-model="message" />
        <p>${message}</p> --}}

        {{-- event binding --}}
        {{-- <button @click="clickInput('hi')">click me</button> --}}

        {{-- methods example --}}
        {{-- <input type="number" @input="handleInput($event)" v-model="keyword">
        <p>${number}</p> --}}

        {{-- use filter --}}
        {{-- ${message | capitalize} --}}

        {{-- use computed --}}
        {{-- Nama lengkap: ${fullName} --}}

        {{-- use watch --}}
        {{-- <p>
            tanya:
            <input v-model="question">
        </p>
        <p>${ answer }</p> --}}

        {{-- use watch 2 --}}
        {{-- Kilometers : <input type="text" v-model="km">
        Meters : <input type="text" v-model="m"> --}}

        {{-- use component --}}
        {{-- <button @click="showTable(true)">show table</button>
        <button @click="showTable(false)">hide table</button>
        <br>
        <table-list :datas="datas" v-if="isShowTable"></table-list> --}}


        {{-- <input type="text" v-model="addTable">
        <button @click="clickAddListTable">Add list</button>
        <table-list :datas="datas"></table-list> --}}
    </div>

    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/lodash.min.js') }}"></script>

    @include('components.table-list')

    <script>
      var app = new Vue({
        delimiters: ['${', '}'],
        // template: '<div id="template">${ message }</div>',
        data() {
          return {
            message: 'its work!!',
            color: 'red',
            number: 0,
            keyword: null,
            firstName: 'arief',
            lastName: 'wijaya',
            question: '',
            answer: '',
            km: 0,
            m: 0,
            isShowTable: false,
            addTable: null,
            datas: [
                {id: 1, name: 'Laravel'},
                {id: 2, name: 'Vue.js'}
            ],
            ctDatas: 0
          }
        },
        created() {
            // console.log('created hooks')
            // console.log(this.message)
            // console.log(document.getElementById('template'))
            // console.log('')
            this.debouncedGetAnswer = _.debounce(this.getAnswer, 500)
        },
        mounted() {
            // console.log('mounted hooks')
            // console.log(this.message)
            // console.log(document.getElementById('template'))
            // console.log('')
        },
        updated() {
            console.log('updated hooks')
            this.ctDatas = this.datas.length
        },
        filters: {
            capitalize: (value) => {
                if (!value) {
                    return ''
                }

                return value.toUpperCase()
            }
        },
        computed: {
            fullName: function () {
                return this.firstName + ' ' + this.lastName
            }
        },
        methods: {
            clickInput(message) {
                alert('click input '+message)
            },
            handleInput(e) {
                if (e.target.value) {
                 this.number = this.toCurrency(e.target.value)
                } else if (!e.target.value) {
                    this.number = 0
                }
            },
            toCurrency(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number)
            },
            getAnswer() {
                if (!this.question) {
                    this.answer = ''
                } else {
                    this.answer = 'saya tidak ngerti apa itu ' + this.question
                }
                return
            },
            showTable(isShown) {
                this.isShowTable = isShown
            },
            clickAddListTable() {
                if (this.addTable !== null) {
                    this.datas.push({
                        id: this.ctDatas + parseInt(1),
                        name: this.addTable
                    })

                    this.addTable = null
                }
            }
        },
        watch: {
            question: function(newValue, oldValue) {
                this.answer = 'thinking...'
                this.debouncedGetAnswer()
            },
            km: function(newValue, oldValue) {
                this.km = newValue
                this.m = newValue * 1000
            },
            m: function(newValue, oldValue) {
                this.km = newValue / 1000
                this.m = newValue
            }
        }
      })

      document.addEventListener("DOMContentLoaded", function(event) {
        app.$mount('#app')
      })
    </script>
  </body>
</html>
