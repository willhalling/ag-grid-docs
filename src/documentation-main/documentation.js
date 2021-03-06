(function () {

    
    var module = angular.module("documentation", []);
    

    /*
     * Show Example directive
     */
    module.directive("showExample", function () {
        return {
            scope: true,
            controller: ShowExampleController,
            templateUrl: "/showExample.html"
        }
    });

    function endsWith(string, test) {
        return string.lastIndexOf(test) + test.length === string.length;
    }

    function ShowExampleController($scope, $http, $attrs) {
        var url = $attrs["url"];
        var example = $attrs["example"];
        $scope.source = url ? url : (example.indexOf("?") === -1 ? (example + ".html") : example);
        $scope.selectedTab = 'example';
        $scope.jsfile = $attrs['jsfile'] ? $attrs['jsfile'] : example;
        $scope.exeExtension = $scope.jsfile.indexOf(".ts") >= 0 || $scope.jsfile.indexOf(".vue") >= 0 ? "" : ".js";
        $scope.htmlFile = $attrs['html'] ? $attrs['html'] : "./" + example + ".html";
        $scope.sourceLang = "JavaScript";
        if ($scope.jsfile.indexOf(".ts") >= 0) {
            $scope.sourceLang = "TypeScript";
        } else if ($scope.jsfile.indexOf(".vue") >= 0) {
            $scope.sourceLang = "Vue";
        }

        $scope.showHtmlTab = $scope.sourceLang !== "Vue";

        if ($attrs.extrapages) {
            $scope.extrapages = $attrs.extrapages.split(',');
            $scope.extraPageContent = {};
            $scope.extrapages.forEach(function (page) {
                $http.get("./" + page).then(function (response) {
                    $scope.extraPageContent[page] = response.data;
                }).catch(function (response) {
                    $scope.extraPageContent[page] = response.data;
                });
            });
        }

        if ($attrs.exampleheight) {
            $scope.iframeStyle = {height: $attrs.exampleheight};
        } else {
            $scope.iframeStyle = {height: '500px'}
        }

        if ($scope.showHtmlTab) {
            $http.get($scope.htmlFile).then(function (response) {
                $scope.html = response.data;
            }).catch(function (response) {
                $scope.html = response.data;
            });
        }
        $http.get("./" + $scope.jsfile + $scope.exeExtension).then(function (response) {
            $scope.javascript = response.data;
        }).catch(function (response) {
            $scope.javascript = response.data;
        });

        $scope.isActive = function (item) {
            return $scope.selectedTab == item;
        };
        $scope.setActive = function (item) {
            $scope.selectedTab = item;
        };
    }

    /*
     * Multi-page (more than just js & html really) Examples with plunker support
     */
    module.directive("showComplexExample", function () {
        return {
            scope: true,
            controller: ShowComplexScriptExampleController,
            templateUrl: "/showComplexExample.html"
        }
    });

    function ShowComplexScriptExampleController($scope, $http, $attrs, $sce) {
        $scope.source = $attrs["example"];
        $scope.selectedTab = 'example';

        $scope.plunker = null;
        if ($attrs.plunker && $attrs.plunker.indexOf("https://embed.plnkr.co") === 0) {
            var plunkerUrl = $attrs.plunker;
            plunkerUrl += (plunkerUrl.indexOf("?") === -1) ? "?" : "&";
            plunkerUrl += "show=preview";

            $scope.plunker = $sce.trustAsResourceUrl(plunkerUrl);
        }

        $scope.extraPages = [];

        var sources = eval($attrs.sources);
        sources.forEach(function(source) {
            var root = source.root;
            var files = source.files.split(',');

            $scope.extraPages = $scope.extraPages.concat(files);

            $scope.extraPageContent = {};
            files.forEach(function (file) {
                $http.get(root + file).then(function (response) {
                    $scope.extraPageContent[file] = response.data;
                }).catch(function (response) {
                    $scope.extraPageContent[file] = response.data;
                });
            });
            $scope.extraPage = $scope.extraPages[0];
        });

        if ($attrs.exampleheight) {
            $scope.iframeStyle = {height: $attrs.exampleheight};
        } else {
            $scope.iframeStyle = {height: '500px'}
        }

        $scope.isActive = function (item) {
            return $scope.selectedTab == item;
        };
        $scope.setActive = function (item) {
            $scope.selectedTab = item;
        };

        $scope.isActivePage = function (item) {
            return $scope.extraPage == item;
        };
        $scope.setActivePage = function (item) {
            $scope.extraPage = item;
        };
    }

    /*
     * plunker only example
     */
    module.directive("showPlunkerExample", function () {
        return {
            scope: true,
            controller: ShowPlunkerScriptExampleController,
            templateUrl: "/showPlunkerExample.html"
        }
    });

    function ShowPlunkerScriptExampleController($scope, $http, $attrs, $sce) {
        $scope.selectedTab = 'editplunker';

        $scope.plunker = null;
        if ($attrs.plunker && $attrs.plunker.indexOf("https://embed.plnkr.co") === 0) {
            var plunkerUrl = $attrs.plunker;
            plunkerUrl += (plunkerUrl.indexOf("?") === -1) ? "?" : "&";
            plunkerUrl += "show=preview";

            $scope.plunker = $sce.trustAsResourceUrl(plunkerUrl);
        }

        $scope.extraPages = [];

        var sources = eval($attrs.sources);
        sources.forEach(function(source) {
            var root = source.root;
            var files = source.files.split(',');

            $scope.extraPages = $scope.extraPages.concat(files);

            $scope.extraPageContent = {};
            files.forEach(function (file) {
                $http.get(root + file).then(function (response) {
                    $scope.extraPageContent[file] = response.data;
                }).catch(function (response) {
                    $scope.extraPageContent[file] = response.data;
                });
            });
            $scope.extraPage = $scope.extraPages[0];
        });

        if ($attrs.exampleheight) {
            $scope.iframeStyle = {height: $attrs.exampleheight};
        } else {
            $scope.iframeStyle = {height: '500px'}
        }

        $scope.isActive = function (item) {
            return $scope.selectedTab == item;
        };
        $scope.setActive = function (item) {
            $scope.selectedTab = item;
        };

        $scope.isActivePage = function (item) {
            return $scope.extraPage == item;
        };
        $scope.setActivePage = function (item) {
            $scope.extraPage = item;
        };
    }

    /*
     * Note directive
     */
    module.directive("note", function () {
        return {
            templateUrl: "/note.html",
            transclude: true
        }
    });

    /*
     * theme tab directive
     */
    module.directive("themeTab", function () {
        return {
            scope: true,
            controller: ThemeTabController,
            templateUrl: "/themeTab.html"
        }
    });

    function ThemeTabController($scope, $http, $attrs) {
        $scope.selectedTab = $attrs["theme"];
        $scope.themes = JSON.parse($attrs["themes"]);

        if ($attrs.frameheight) {
            $scope.iframeStyle = {height: $attrs.frameheight};
        } else {
            $scope.iframeStyle = {height: '500px'}
        }

        $scope.isActive = function (item) {
            return $scope.selectedTab == item;
        };
        $scope.setActive = function (item) {
            $scope.selectedTab = item;
        };

        $scope.setTheme = function (theme) {
            $scope.selectedTab = theme
        };

        $scope.isSelected = function (theme) {
            return $scope.selectedTab == theme
        };
    }

    module.directive('script', function () {
        return {
            restrict: 'E',
            scope: false,
            link: function (scope, elem, attr) {
                if (attr.type === 'text/javascript-lazy') {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    var src = elem.attr('src');
                    if (src !== undefined) {
                        s.src = src;
                    }
                    else {
                        var code = elem.text();
                        s.text = code;
                    }
                    document.head.appendChild(s);
                    // elem.remove();
                }
            }
        };
    });


    /*
     * Local storage/remember toggle state
     */

    var localStorageKey = "agGrid_expandAll";
    var toggleClasses = document.getElementsByClassName("docsMenu-header");
    var expandAllState = JSON.parse(localStorage.getItem('agGrid_expandAll')); 
    var expandAllLink = document.getElementsByClassName("expandAll");

    /* close framework dropdown when clicking outside */
    document.body.addEventListener('click', handleBodyClick, true); 
    function handleBodyClick() {
        var frameworkElement = document.querySelectorAll('.frameworkBox');
        var frameworkLink = document.querySelectorAll('.frameworkDropdownButton'); 
        if (frameworkElement[0]) {
            if (!frameworkElement[0].contains(event.target)) {
                frameworkLink[0].classList.remove("active");
            }
        }
    }

    for (var i = 0; i < toggleClasses.length; i++) {
        toggleClasses[i].addEventListener('click', handleToggle, false);
    }


    function handleToggle() {
        var id = this.dataset.id;
        
        resetSingleToggle(id);
        
        this.classList.toggle("active");
        /* if user is using normal menu reset expand all */
        if (!this.classList.contains("active")) {
            expandAllLink[0].innerHTML = "Expand All <i class='fa fa-arrow-right' aria-hidden='true'></i>";
            localStorage.setItem(localStorageKey, false);
        }
    }

    function resetSingleToggle(id) {
        for (var i = 0; i < toggleClasses.length; i++) {
            if (toggleClasses[i].dataset.id !== id) {
                toggleClasses[i].classList.remove("active");
            }
        }
    }

    /* expand all dropdowns */
    if (expandAllLink[0]) {
        expandAllLink[0].addEventListener('click', function(){
            if (this.text.indexOf('Expand') > -1) {
                expandAll();
            } else {
                closeAll();
            }
        }, true);         
    }

    function expandAll() {
        for (var i = 0; i < toggleClasses.length; i++) {
            toggleClasses[i].classList.add("active");
            expandAllLink[0].innerHTML = "Close All <i class='fa fa-arrow-down' aria-hidden='true'></i>";
            localStorage.setItem(localStorageKey, true);
        }
    }

    function closeAll() {
        for (var i = 0; i < toggleClasses.length; i++) {
            toggleClasses[i].classList.remove("active");
            expandAllLink[0].innerHTML = "Expand All <i class='fa fa-arrow-right' aria-hidden='true'></i>";
            localStorage.setItem(localStorageKey, false);
        }
    }

    /* framework dropdown menu */
    var FrameworkLinks = document.getElementsByClassName("frameworkDropdown-link");

    for (var i = 0; i < FrameworkLinks.length; i++) {
        FrameworkLinks[i].addEventListener('click', handleFrameworkChange, false);
    }

    function handleFrameworkChange() {
        var framework = this.dataset.id;
        window.location.href = '?framework=' + framework;
    }

    initDocsMenu();

    function initDocsMenu() {
        if (expandAllState) {
            expandAll();
        }
    }
    

})();