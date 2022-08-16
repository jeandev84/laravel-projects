<template>
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-center">

            <ul class="uk-navbar-nav">
                <li v-for="link in links">
                    <a :href="link.href">{{ link.title }}</a>
                </li>
            </ul>
        </div>
     </nav>
</template>

<script>
export default {
    // name: "Header"

    data() {
        return {
            links: [
                {
                    title: "Главная",
                    href: "/"
                },
                {
                    title: "Блог",
                    href: "/blog"
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
