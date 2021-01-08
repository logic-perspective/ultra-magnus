<template>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li  v-bind:class="{ 'active': $route.name === 'dashboard' }" class="nav-item">
                <router-link v-bind:to="{ name: 'dashboard' }"
                            class="nav-link">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </router-link>
            </li>

            <li  v-bind:class="{ 'active': $route.name === 'heatmap' }" class="nav-item">
                <router-link v-bind:to="{ name: 'heatmap' }"
                             class="nav-link">
                    <i class="material-icons">location_on</i>
                    <p>Heat Map</p>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "navigation-sidebar",
    }
</script>