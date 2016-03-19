<?php
class graphTests extends PHPUnit_Framework_TestCase
{
	public $graph;

	public function setUp() {
		$this->graph = new graph();
	}

	public function testAddEdge() {
		$this->graph->addEdge("A", "B");
		$this->assertEquals(array("B"), $this->graph->adjacency["A"]);

		$this->graph->addEdge("A", "C");
		$this->assertEquals(array("B", "C"), $this->graph->adjacency["A"]);
		
		$this->graph->addEdge("B", "D");
		$this->assertEquals(array("D"), $this->graph->adjacency["B"]);

		$this->graph->addEdge("C", "F");
		$this->assertEquals(array("F"), $this->graph->adjacency["C"]);
	}

	public function testAddEdges() {
		$adjacency = array("B", "C", "D");
		$this->graph->addEdges("A", $adjacency);
		$this->assertEquals($adjacency, $this->graph->adjacency["A"]);
	}

	public function testGetPaths() {
		$this->graph->addEdges("A", array("B", "C"));
		$this->graph->addEdge("B", "D");
		$this->graph->addEdge("C", "D");

		$this->assertEquals(array(array("A", "B")), $this->graph->getPaths("A", "B"));
		$this->assertEquals(array(array("A", "B", "D"), array("A", "C", "D")), $this->graph->getPaths("A", "D"));
	}
}
