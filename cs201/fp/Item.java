//Name: Khi Hua Chou && Palmer Campbel
//Final Project
//Monday, May 13, 2013

public class Item {
	//instance variable
	protected boolean[][] main;
	protected boolean[][] red;
	protected boolean[][] blue;
	protected int row;


	//constructor
	public Item(int row, int col) {
		main = new boolean[row][col];
		red = new boolean[row][col];
		blue = new boolean[row][col];
	}

	//return the red boolean array
	public boolean[][] getRed(){
		return red;
	}

	//return the column number
	public int getColumn(){
		return main[0].length;
	}

	//returns the row that is -1 if nothing was added
	public int ifadded(){
		return row;
	}
	//return the blue boolean array
	public boolean[][] getBlue(){
		return blue;
	}
	//return the red boolean array
	public boolean[][] getMain(){
		return main;
	}

	//update the red array
	public void update_red(int row, int col){
		if (red[row][col] == true){
			//do nothing
		}
		else{
			red[row][col] = true;
		}


	}

	//update the blue array
	public void update_blue(int row, int col){
		if (blue[row][col] == true){
			//do nothing
		}
		else{
			blue[row][col] = true;
		}
	}

	//return full which tells whether the column is full or not
	public boolean isfull(int x){
		if(main[0][x] == true){
			return true;
		}
		else{
			return false;
		}
	}


	//use to add the pieces in the array
	public void add(int col, String color){
		//use to check if anything is done at all;
		int temp_row = -1;

		//check if it is full since main[0] is the first row
		if (main[0][col] == true){

		}
		//check if column is empty, if so, add it directly there.
		else if(main[main.length-1][col] == false){
			main[main.length-1][col] = true;
			temp_row = main.length-1;

		}

		else{
			int i = 1;

			//optain the i value that represents the row number
			while(main[i][col] != true){
				i++;
			}	
			//reduce it back by one since it is always off by 1 more.
			i--;

			//update the row number
			main[i][col] = true;

			//
			temp_row = i;

		}

		//if something is done therefore temp_row != -1, then update red and blue
		if(temp_row != -1){
			if(color == "red"){
				update_red(temp_row, col);
			}
			else{
				update_blue(temp_row,col);

			}
			//update the row since it is important to know if something has been added
			//or not
			row = temp_row;
		}
	}
}