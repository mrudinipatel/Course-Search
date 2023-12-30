## JS Graph Visualization Research Notes


#### What is it?
JavaScript has several libraries that allow for graph visualization. This includes using data to build charts, tree maps, bar graphs, and much more. 


### Some things I came across:
https://www.monterail.com/blog/javascript-libraries-data-visualization#:~:text=React%2Dvis,-GitHub%20Stars%3A%208%2C100&text=It's%20a%20simple%20Javascript%20graph,offers%20a%20lot%20of%20flexibility. 
- From this site, I feel like D3 or React Vis could be good libraries we can consider.
- https://codesandbox.io/examples/package/react-tree-vis 
- This link provides some starting samples we can use to make a tree structure using React Vis.


https://www.cssscript.com/semantic-hierarchy-tree-treeflex/
- I also found this resource, but it seems to be more CSS based, so I'm not entirely sure if this would be allowed but it's an option nevertheless.


https://github.com/marmelab/tree.js/
- This open source repo makes use of a library called tree.js to build tree structures with nodes.
- I'm not sure how useful this would be, but again it's an option.


https://js.cytoscape.org/ 
- JavaScript also has this library called cytoscape.js which offers a wide variety of different graphics. I am leaning more towards using its 'Dagre Layout' for this sprint, just because it seems well-suited for mapping prerequisites in comparison to the other layouts this library offers.
- https://github.com/cytoscape/cytoscape.js-dagre
- This is the link to the dagre layout open source repo. I think it is a good reference to build off of, if we decide to use it.


### My personal choice:
- After doing some library research, I still think we should go with D3.js just because it is the most active library in terms of development and there are many resources available online to improve our understanding of it.
- Official D3.js website: http://d3js.org/
- Helpful starting example: https://observablehq.com/@d3/gallery?utm_source=d3js-org&utm_medium=hero&utm_campaign=try-observable 

- From my research, it seems that D3.js is the most powerful visualization library offered by JavaScript.


### Here is how you add heirarchy to a tree using D3.js:
```c
const data = {
  name: "Eve",
  children: [
    {name: "Cain"},
    {name: "Seth", children: [{name: "Enos"}, {name: "Noam"}]},
    {name: "Abel"},
    {name: "Awan", children: [{name: "Enoch"}]},
    {name: "Azura"}
  ]
};

const root = d3.hierarchy(data);
```
We can use a function similar to the one below to return the children of a specific root/node. This can be useful if we are considering to implement a 'GET' functionality to our tree.
```c
function children(d) {
  return d.children;
}
```
