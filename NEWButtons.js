var buttonList = [
    {
        name: "prev",
        text: "<",
    },
    {
        name: "next",
        text: ">",
    }
];

d3.select('div#month>ul')
    .selectAll("button")
    .data(buttonList)
    .enter()
    .append("button")
    .attr("class", function(d) { return d.name; })
    .text(function(d) { return d.text; })
