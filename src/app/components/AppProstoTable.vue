<template>
    <div id="app">
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Компания</th>
                    <th>Должность</th>
                    <th>Дата создания</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
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
            users: []
        };
    },
    mounted() {
        this.fetchUsers();
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
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
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
