document.onreadystatechange = () => {
    if (document.readyState === 'complete') {
        var dropdown = document.getElementById("purpose")
        var specified_container = document.getElementById("specified-container")
        var specified = document.getElementById("specified")

        specified.oninput = function() { localStorage.setItem("specified", specified.value) }

        specified.value = localStorage.getItem("specified")

        function onChange() {
            let value = dropdown.value

            if (value) {
                localStorage.setItem("purpose", value)
            } else {
                dropdown.value = localStorage.getItem("purpose") ?? '';
                value = dropdown.value;
            }

            if (value === 'Others') {
                specified_container.classList.remove("hidden")
                specified_container.classList.add("visible")
            } else {
                specified_container.classList.remove("visible")
                specified_container.classList.add("hidden")
            }
        }

        onChange()

        dropdown.onchange = onChange
    }
};