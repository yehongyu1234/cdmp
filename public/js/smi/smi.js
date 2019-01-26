var smi=function (menuId,infoId,canvasId, files) {
    var scene3 = new xeogl.Scene({
        canvas:canvasId
    });
    var file = files[0];
    var camera = scene3.camera;
    var input = scene3.input;

    var lights = xeogl.scene.lights;
    var host=window.location.host;
    //console.log(host);

    lights.lights = [
        new xeogl.AmbientLight({
            color: [0.6, .9, 1.0],
            intensity: 0.8
        }),
        new xeogl.DirLight({
            dir: [0.1, -0.6, -0.8],
            color: [1.0, 1.0, 1.0],
            intensity: 1.0,
            space: "view"
        }),
        new xeogl.DirLight({
            dir: [-0.8, -0.4, -0.4],
            color: [1.0, 1.0, 1.0],
            intensity: 1.0,
            space: "view"
        }),
        new xeogl.DirLight({
            dir: [0.2, -0.8, 0.8],
            color: [0.6, 0.6, 0.6],
            intensity: 1.0,
            space: "view"
        })
    ];

    var gearbox = new xeogl.GLTFModel(scene3, {
        id: "yhy",
        ghosted: true,

        lambertMaterials: true,
        src: file.src
    });


    camera.eye = [-14.63, 22.88, 10.04];
    camera.look = [10.98, 5.82, -11.23];
    camera.up = [0.35, 0.88, -0.29];
    camera.perspective.near=0.4;
    camera.perspective.fov=45;
    camera.perspective.far=100000;
    var cameraControl = new xeogl.CameraControl(scene3,{
        doublePickFlyTo: true
    });


    var cameraFlight = new xeogl.CameraFlightAnimation();

    //new xeogl.CameraControl(scene3);
    //选择模型
    cameraControl.on("hoverEnter", function (hit) {
        hit.entity.highlighted = true;
    });

    cameraControl.on("hoverOut", function (hit) {
        hit.entity.highlighted = false;
    });

    cameraControl.on("picked", function (hit) {
        var entity = hit.entity;
        //console.log(entity);

        if (input.keyDown[input.KEY_SHIFT]) {
            entity.selected = !entity.selected;
            entity.highlighted = !entity.selected;
        } else {
            cameraFlight.flyTo(entity);
            //显示信息
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(infoId).innerHTML = this.responseText;
                }
            };
            str = entity.id;
            uid = str.split("#");
            endid = uid[1].split(".")
            xmlhttp.open("GET", "2.php?id=" + endid[0], true);
            xmlhttp.send();
        }
    });
    cameraControl.on("pickedNothing", function (hit) {
        cameraFlight.flyTo(gearbox);
    });
    //选择列表
    window.selectObject = (function () {
        var lastEntity;
        var htmlinfo ='';
        return function (id) {
            //console.log(id);
            if (!id) {
                cameraFlight.flyTo();
                if (lastEntity) {
                    lastEntity.ghosted = true;
                    lastEntity.highlighted = true;
                    lastEntity = null;
                }
                return;
            }
            var entity = gearbox.scene.entities[id];
            //console.log(entity.id);
            //通过php获取数据的信息并检索出显示出来
            //模型调转到选择编号的位置
            if (entity) {
                if (lastEntity) {
                    lastEntity.ghosted = true;
                    lastEntity.highlighted = false
                }
                entity.ghosted = false;
                entity.highlighted = true;
                cameraFlight.flyTo({
                    aabb: entity.aabb,
                    fitFOV: 25,
                    duration: 1.0,
                    showAABB: false
                });
                lastEntity = entity;
                //显示信息
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(infoId).innerHTML = this.responseText;
                    }
                };
                str=entity.id;
                uid=str.split("#");
                endid=uid[1].split(".")
                xmlhttp.open("GET", "2.php?id=" + endid[0], true);
                xmlhttp.send();
            }
        };
    })();
    gearbox.on("loaded", function () {
        var html = [""];
        var i = 0;
        html.push("构件清单：<br>");
        html.push("<hr/>");
        for (var entityId in gearbox.entities) {
            if (gearbox.entities.hasOwnProperty(entityId)) {
                var entity = gearbox.entities[entityId];
                var numberid=entity.id.split("/")[0].split('#')[1];
                html.push("<a href='javascript:selectObject(\"" + entity.id + "\")'>" + numberid + "</a><br>")

            }
        }
        document.getElementById(menuId).innerHTML = html.join("");

        cameraFlight.jumpTo({
            aabb: gearbox.aabb,
            fit: true,
            fitFOV: 45
        });
    });

};
