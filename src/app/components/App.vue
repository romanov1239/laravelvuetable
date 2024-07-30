<template>
    <div id="app">
        <div class="table-header">
            <br>
            <br>

            Интерактивная таблица с прокруткой стрелками PgUp, PgDn и кнопками управления.
            Пользователи добавлены из базы данных. Проект Laravel-Vue.
            <br>

            <br>
        </div>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>
                        Имя
                        <span class="arrow" @click="moveDown">&#x25B2;</span>
                        <span class="arrow" @click="moveUp">&#x25BC;</span>
                    </th>
                    <th>Email</th>
                    <th>Компания</th>
                    <th>Должность</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in visibleUsers" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.company }}</td>
                    <td>{{ user.position }}</td>
                    <td>{{ new Date(user.created_at).toLocaleDateString() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App',
    data() {
        return {
            users: [],
            currentIndex: 0,
            visibleCount: 3 // Количество отображаемых строк
        };
    },
    computed: {
        visibleUsers() {
            return this.users.slice(this.currentIndex, this.currentIndex + this.visibleCount);
        }
    },
    mounted() {
        this.fetchUsers();
        window.addEventListener('keydown', this.handleKeyDown);
    },
    beforeDestroy() {
        window.removeEventListener('keydown', this.handleKeyDown);
    },
    methods: {
        async fetchUsers() {
            try {
                const response = await fetch('http://localhost:8000/api/users'); // URL вашего API
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                this.users = await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
            }
        },
        handleKeyDown(event) {
            if (event.key === 'ArrowUp') {
                this.moveUp();
            } else if (event.key === 'ArrowDown') {
                this.moveDown();
            }
        },
        moveUp() {
            this.currentIndex = Math.max(this.currentIndex - 1, 0);
        },
        moveDown() {
            this.currentIndex = Math.min(this.currentIndex + 1, this.users.length - this.visibleCount);
        }
    }
}
</script>

<style scoped>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
}

#app {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    width: 100%;
}

.table-header {
    font-size: 24px; /* Крупный размер шрифта */
    font-weight: bold;
    margin-bottom: 20px; /* Отступ снизу */
}

.table-container {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 8px;
    overflow: hidden;
    table-layout: fixed;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
    border-radius: 4px;
    word-wrap: break-word;
}

th {
    background-color: #f4f4f4;
    position: relative;
}

th .arrow {
    cursor: pointer;
    font-size: 12px;
    margin-left: 5px;
}

thead th:first-child {
    border-top-left-radius: 8px;
}

thead th:last-child {
    border-top-right-radius: 8px;
}

tbody tr:last-child td:first-child {
    border-bottom-left-radius: 8px;
}

tbody tr:last-child td:last-child {
    border-bottom-right-radius: 8px;
}

tbody td {
    border-radius: 0;
}
</style>
