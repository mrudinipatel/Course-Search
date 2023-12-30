<nav>
    <!-- Accessibility fix: only use onclick on keyboard-navigable elements (e.g. buttons, links) -->
    <button class="hamburger" onclick="function hamburger() {
        const x = document.getElementById('hiddenLinks');
        if (x.style.display === 'none') {
            x.style.display = 'flex';
        } else {
            x.style.display = 'none';
        }
    } hamburger();">
        <i class="menuIcon material-icons">menu</i>
    </button>

    <a href="/" <?php if ($_SERVER['SCRIPT_NAME'] == "/index.php") { ?> class="active" <?php   }  ?>>Home</a>
    <a href="/excel" <?php if ($_SERVER['SCRIPT_NAME'] == "/excel.php") { ?> class="active" <?php   }  ?>>Excel</a>
    <a href="/about" <?php if ($_SERVER['SCRIPT_NAME'] == "/about.php") { ?> class="active" <?php   }  ?>>About Us</a>
    <a href="/api" <?php if ($_SERVER['SCRIPT_NAME'] == "/api.php") { ?> class="active" <?php   }  ?>>API</a>
    <a href="/courseSearch" <?php if ($_SERVER['SCRIPT_NAME'] == "/courseSearch.php") { ?> class="active" <?php   }  ?>>Course Search</a>
    <a href="/planByPrereq" <?php if ($_SERVER['SCRIPT_NAME'] == "/planByPrereq.php") { ?> class="active" <?php   }  ?>>Graph</a>
    <a href="/gradeCalculator" <?php if ($_SERVER['SCRIPT_NAME'] == "/gradeCalculator.php") { ?> class="active" <?php   }  ?>>Grade Calculator</a>
    <a href="/resources" <?php if ($_SERVER['SCRIPT_NAME'] == "/resources.php") { ?> class="active" <?php   }  ?>>Resources</a>
    <div style="flex-grow: 1;"></div>
    <button id="themeToggle"> </button>
    <a class="download-button" href="/download.php">Download</a>
</nav>
<div id="hiddenLinks" style="display: none;">
    <a href="/" <?php if ($_SERVER['SCRIPT_NAME'] == "/index.php") { ?> class="active" <?php   }  ?>>Home</a>
    <a href="/excel" <?php if ($_SERVER['SCRIPT_NAME'] == "/excel.php") { ?> class="active" <?php   }  ?>>Excel</a>
    <a href="/about" <?php if ($_SERVER['SCRIPT_NAME'] == "/about.php") { ?> class="active" <?php   }  ?>>About Us</a>
    <a href="/api" <?php if ($_SERVER['SCRIPT_NAME'] == "/api.php") { ?> class="active" <?php   }  ?>>API</a>
    <a href="/courseSearch" <?php if ($_SERVER['SCRIPT_NAME'] == "/courseSearch.php") { ?> class="active" <?php   }  ?>>Course Search</a>
    <a href="/planByPrereq" <?php if ($_SERVER['SCRIPT_NAME'] == "/planByPrereq.php") { ?> class="active" <?php   }  ?>>Graph</a>
    <a href="/gradeCalculator" <?php if ($_SERVER['SCRIPT_NAME'] == "/gradeCalculator.php") { ?> class="active" <?php   }  ?>>Grade Calculator</a>
    <a href="/resources" <?php if ($_SERVER['SCRIPT_NAME'] == "/resources.php") { ?> class="active" <?php   }  ?>>Resources</a>
</div>