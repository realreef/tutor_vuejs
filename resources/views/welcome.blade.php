<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

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
        {{-- <table-list :datas="datas"></table-list> --}}
    </div>

    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>

    @include('components.table-list')

    <script>
      var app = new Vue({
        delimiters: ['${', '}'],
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
            datas: [
                {id: 1, name: 'Laravel'},
                {id: 2, name: 'Vue.js'}
            ]
          }
        },
        created() {
            this.debouncedGetAnswer = _.debounce(this.getAnswer, 500)
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
