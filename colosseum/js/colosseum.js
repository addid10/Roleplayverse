// // onload function, so Lato loads before the program starts
// onload = main;


// function main() {
//     // Define player object and statistics
//     var player = {};
//     player.Health = 61;
//     player.Defense = 45;
//     player.Agility = 33;
//     player.Intellect = 90;
//     player.Power = 42;
//     player.Luck = 70;
//     player.Dexterity = 70;
//     player.Stealth = 70;
//     player.Recovery = 70;
//     player.Charisma = 70;
//     var statOrder = [];
//     for (var i in player) statOrder.push(i);
//     var statColors = {};
//     statColors.Health = "#000000";
//     statColors.Defense = "#000000";
//     statColors.Agility = "#000000";
//     statColors.Intellect = "#000000";
//     statColors.Power = "#000000";
//     statColors.Charisma = "#000000";
//     statColors.Recovery = "#000000";
//     statColors.Dexterity = "#000000";
//     statColors.Luck = "#000000";
//     statColors.Stealth = "#000000";
//     statColors.white = "#FFFFFF";

//     // Define pentagon (or other polygon) size and coordinates.
//     var polygonX = 240;
//     var polygonY = 240;
//     var polygonSize = 120;
//     // Define size of circles.
//     var circleSize = 50;
//     var circles = [];
//     var circleIndexes = [];
//     for (var i in statColors) circleIndexes.push({
//         defaultColor: statColors[i],
//         color: statColors[i],
//         over: false
//     });

//     var innerPolygonColor = statColors.white;
//     var innerPolygonKnobs = [];
//     for (var i in statColors) innerPolygonKnobs.push({
//         over: false,
//         dragging: false
//     });

//     // Place canvas object centered in the screen.
//     var canvas = document.getElementById('atalieBau');
//     // Get canvas context.
//     var ctx = canvas.getContext("2d");

//     String.prototype.toRGB = function () {
//         var obj;
//         var triplet = this.slice(1, this.length);
//         var colors = [];
//         var index = 0;
//         for (var i = 0; i < triplet.length; i += 2) {
//             colors[index] = parseInt("0x" + triplet[i] + triplet[i + 1]);
//             index++;
//         }
//         obj = {
//             string: "rgb(" + colors[0] + ", " + colors[1] + ", " + colors[2] + ")",
//             red: colors[0],
//             green: colors[1],
//             blue: colors[2],
//         };
//         return obj;
//     }

//     var vertices = [];

//     function drawRegularPolygon(x, y, fill, stroke, strokeWidth, sides, radius) {
//         // Draws a regular polygon onto the canvas.
//         // Note that a circle can be made by setting sides to radius/2.

//         // Variable declarations
//         var arc;
//         var x;
//         var y;
//         var point;
//         var points = [];

//         // Begin drawing with parameters
//         ctx.beginPath();
//         ctx.fillStyle = fill;
//         ctx.strokeStyle = stroke;
//         ctx.lineWidth = strokeWidth;
//         // Add round line joints
//         ctx.lineJoin = 'round';
//         // Using sides+1 because the sides should be linked properly.
//         for (var i = 0; i <= sides + 1; i++) {
//             // Create arc variable
//             arc = i * 2 * Math.PI / sides;
//             // Add coordinates to array for reuse
//             point = {};
//             point.x = x + radius * Math.sin(arc);
//             point.y = y - radius * Math.cos(arc);
//             if (i === 0) ctx.moveTo(point.x, point.y);
//             else ctx.lineTo(point.x, point.y);
//             // Prevent point duplication
//             if (i < sides + 1) points.push(point);
//         }
//         // Draw polygon
//         ctx.fill();
//         ctx.stroke();
//         // Close path, just in case
//         ctx.closePath();
//         // Return points array for future use
//         return points;
//     }
//     var circles = [];

//     function redraw() {
//         circles = [];
//         // Fill canvas with black.
//         ctx.rect(0, 0, canvas.width, canvas.height);
//         ctx.fillStyle = "transparent";
//         ctx.fill();

//         var polygon = drawRegularPolygon(polygonX, polygonY, "#666", "#333", 2, statOrder.length, polygonSize);
//         ctx.beginPath();
//         ctx.setLineDash([5]);
//         ctx.lineDashOffset = 10;
//         ctx.strokeStyle = "#333";
//         for (var i = 0; i < polygon.length; i++) {
//             ctx.moveTo(polygonX, polygonY);
//             ctx.lineTo(polygon[i].x, polygon[i].y);
//         }
//         ctx.stroke();
//         // Remove line dash for future use
//         ctx.setLineDash([0]);

//         // Inner polygon
//         ctx.beginPath();
//         var index;
//         var stat;
//         var text;
//         var innerPolygonVertices = [];
//         var distX;
//         var distY;
//         var distTotal;
//         var x;
//         var y;
//         for (var i = 0; i < statOrder.length + 1; i++) {
//             index = i % statOrder.length;
//             if (vertices[index] === undefined) vertices[index] = {};
//             if (innerPolygonVertices[index] === undefined) innerPolygonVertices[index] = {};
//             vertices[index].x = polygon[index].x;
//             vertices[index].y = polygon[index].y;
//             stat = player[statOrder[index]];
//             vertices[index].distX = distX = vertices[index].x - polygonX;
//             vertices[index].distY = distY = vertices[index].y - polygonY;
//             vertices[index].distTotal = Math.sqrt(distX * distX + distY * distY);
//             vertices[index].radians = Math.atan2(distY, distX);
//             x = polygonX + Math.cos(vertices[index].radians) * (vertices[index].distTotal * stat / 100);
//             y = polygonY + Math.sin(vertices[index].radians) * (vertices[index].distTotal * stat / 100);
//             innerPolygonVertices[index].x = x;
//             innerPolygonVertices[index].y = y;
//             ctx.lineTo(x, y);
//         }
//         // Set alpha of polygon
//         ctx.globalAlpha = 0.5;
//         ctx.fillStyle = innerPolygonColor;
//         ctx.fill();

//         ctx.globalAlpha = 1;
//         ctx.strokeStyle = innerPolygonColor;
//         ctx.stroke();

//         for (var i = 0; i < innerPolygonVertices.length; i++) {
//             x = innerPolygonVertices[i].x;
//             y = innerPolygonVertices[i].y;
//             innerPolygonKnobs[i].x = x;
//             innerPolygonKnobs[i].y = y;
//             if (innerPolygonKnobs[i].over || innerPolygonKnobs[i].dragging) {
//                 ctx.beginPath();
//                 ctx.arc(x, y, 8, 0, 2 * Math.PI, false);
//                 ctx.strokeStyle = statColors[statOrder[index]];
//                 ctx.stroke();
//                 ctx.closePath();
//             }
//         }

//         // Draw circles;
//         for (var i = 0; i < statOrder.length; i++) {
//             index = i;
//             x = vertices[index].x + Math.cos(vertices[index].radians) * (circleSize + 8);
//             y = vertices[index].y + Math.sin(vertices[index].radians) * (circleSize + 8);
//             ctx.beginPath();
//             ctx.arc(x, y, circleSize, 0, 2 * Math.PI, false);
//             ctx.fillStyle = '#333';
//             ctx.fill();
//             ctx.closePath();
//             ctx.beginPath();
//             ctx.arc(x, y, circleSize - 4, 0, 2 * Math.PI, false);
//             ctx.fillStyle = "#fff";
//             if (circleIndexes[index].over) ctx.fillStyle = statColors[statOrder[index]];
//             ctx.fill();
//             ctx.closePath();
//             ctx.beginPath();
//             ctx.arc(x, y, circleSize - 6, 0, 2 * Math.PI, false);
//             ctx.fillStyle = statColors[statOrder[index]];
//             if (circleIndexes[index].over) ctx.fillStyle = "#fff";
//             ctx.fill();
//             ctx.closePath();
//             circles.push({
//                 x: x,
//                 y: y,
//                 size: circleSize - 6,
//                 radius: (circleSize - 6) / 2,
//                 stat: statOrder[index],
//                 color: statColors[statOrder[index]]
//             });
//             ctx.fillStyle = "#fff";
//             if (circleIndexes[index].over) ctx.fillStyle = statColors[statOrder[index]];
//             ctx.font = "16px Lato";
//             text = statOrder[index].toUpperCase();
//             stat = player[statOrder[index]] + "%";
//             ctx.fillText(text, x - ctx.measureText(text).width / 2, y);
//             ctx.fillText(stat, x - ctx.measureText(stat).width / 2, y + 16);
//         }
//     }
//     redraw();

// }