var gltfExplorer = function (menuId,infoId, files) {
    window.onload = function () {
        var div = document.getElementById(menuId);
        //console.log(div);
        Ps.initialize(div);
    };
    if (files.length === 0) {
        return;
    }
    var file = files[0];
    var lights = xeogl.scene.lights;

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
        })
        ,

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

    lights.reflectionMap = new xeogl.CubeTexture({
        src: [
            "textures/reflect/Uffizi_Gallery/Uffizi_Gallery_Radiance_PX.png",
            "textures/reflect/Uffizi_Gallery/Uffizi_Gallery_Radiance_NX.png",
            "textures/reflect/Uffizi_Gallery/Uffizi_Gallery_Radiance_PY.png",
            "textures/reflect/Uffizi_Gallery/Uffizi_Gallery_Radiance_NY.png",
            "textures/reflect/Uffizi_Gallery/Uffizi_Gallery_Radiance_PZ.png",
            "textures/reflect/Uffizi_Gallery/Uffizi_Gallery_Radiance_NZ.png"
        ]
    });

    lights.lightMap = new xeogl.CubeTexture({
        src: [
            "textures/light/Uffizi_Gallery/Uffizi_Gallery_Irradiance_PX.png",
            "textures/light/Uffizi_Gallery/Uffizi_Gallery_Irradiance_NX.png",
            "textures/light/Uffizi_Gallery/Uffizi_Gallery_Irradiance_PY.png",
            "textures/light/Uffizi_Gallery/Uffizi_Gallery_Irradiance_NY.png",
            "textures/light/Uffizi_Gallery/Uffizi_Gallery_Irradiance_PZ.png",
            "textures/light/Uffizi_Gallery/Uffizi_Gallery_Irradiance_NZ.png"
        ]
    }); 
    var model = new xeogl.GLTFModel({
        id: "yhy",
        src: file.src,
        ghosted: true,
        //ghostEdgeThreshold: 20,
        lambertMaterials: true

       // transform: new xeogl.Scale({
       //     xyz: [100, 100, 100]
       // })
    });
    //console.log(src);
    //  model.scene.camera.gimbalLock = false;
    var scene = model.scene;
    var camera = scene.camera;
    var input = scene.input;

    camera.eye = [-14.63, 22.88, 10.04];
    camera.look = [10.98, 5.82, -11.23];
    camera.up = [0.35, 0.88, -0.29];
    camera.perspective.near=0.4;
    camera.perspective.fov=45;
    camera.perspective.far=100000;  

    var cameraControl = new xeogl.CameraControl({
        doublePickFlyTo: false
    });
    var cameraFlight = new xeogl.CameraFlightAnimation();
    //选择模型
    cameraControl.on("hoverEnter", function (hit) {
        hit.entity.highlighted = true;
    });

    cameraControl.on("hoverOut", function (hit) {
        hit.entity.highlighted = false;
    });

    cameraControl.on("picked", function (hit) {
        var entity = hit.entity;
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
        cameraFlight.flyTo(model);
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
                    lastEntity.ghosted = false;
                    lastEntity.highlighted = false;
                    lastEntity = null;
                }
                return;
            }
            var entity = model.scene.entities[id];
            //console.log(entity.id);
            //通过php获取数据的信息并检索出显示出来
            //模型调转到选择编号的位置
            if (entity) {
                if (lastEntity) {
                    lastEntity.ghosted = false;
                    lastEntity.highlighted = false;
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
    model.on("loaded", function () {
        var html = [""];        
        var i = 0;
        //console.log(model.entities);
        html.push("构件清单：<br>");
        html.push("<hr/>");
        for (var entityId in model.entities) {
            if (model.entities.hasOwnProperty(entityId)) {
                var entity = model.entities[entityId]; 
                var numberid=entity.id.split("/")[0].split('#')[1];
               // console.log(numberid);
                html.push("<a href='javascript:selectObject(\"" + entity.id + "\")'>" + numberid + "</a><br>")
                
            }
        }               
        document.getElementById(menuId).innerHTML = html.join("");     

        cameraFlight.jumpTo({
            aabb: model.aabb,
            fit: true,
            fitFOV: 45
        });
    });
    var cameraControl = new xeogl.CameraControl();
     new xeogl.AxisHelper({
         lookat: scene.camera,
         visible: true,
         size: [200, 200]
     });
};